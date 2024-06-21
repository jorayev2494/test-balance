<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Contracts\BaseModelRepository;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Filters\FiltersOperatorMapper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use DateTimeImmutable;
use Illuminate\Support\Facades\DB;

readonly class TransactionRepository extends BaseModelRepository implements TransactionRepositoryInterface
{
    private const FILTER_COLUMNS = [
        'title',
        'income',
        'amount',
        'cost',
        'created_at',
    ];

    protected function getModelClassName(): string
    {
        return Transaction::class;
    }

    public function paginate(int $authorId, array $filters = []): LengthAwarePaginator
    {
        $query = $this->getModelClone()->newQuery()
            ->where('author_id', $authorId);

        foreach (FiltersOperatorMapper::parse($filters, ['amount']) as ['column' => $column, 'operator' => $operator, 'value' => $value]) {
            $query->where($column, $operator, $value);
        }

        return $query->orderBy('id', 'DESC')->paginate();
    }

    /**
     * @param int $id
     * @return Transaction|Model
     */
    public function find(int $id): ?Transaction
    {
        return $this->getModelClone()->newQuery()->find($id);
    }

    /**
     * @param int $authorId
     * @return Transaction|Model|null
     */
    public function getCurrentBalance(int $authorId): ?Transaction
    {
        return $this->getModelClone()->newQuery()
            ->where('author_id', $authorId)
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * @param int $authorId
     * @param DateTimeImmutable|null $startDate
     * @param DateTimeImmutable|null $endDate
     * @return Transaction|null
     */
    public function getBalance(int $authorId, string $startDate = null, string $endDate = null): ?Transaction
    {
        $query = $this->getModelClone()->newQuery()
            ->select(
                DB::raw('
                    COALESCE(SUM(id), 0) AS id,
                    COALESCE(SUM(income), 0) AS income,
                    COALESCE(SUM(cost), 0) AS cost,
                    COALESCE(SUM(amount), 0) AS amount
                ')
            )
            ->where('author_id', $authorId)
            ->when(! is_null($startDate), static function (Builder $qb) use($startDate): void {
                $qb->whereDate('created_at', '<=', $startDate);
            })
            ->when(! is_null($endDate), static function (Builder $qb) use($endDate): void {
                $qb->whereDate('created_at', '>=', $endDate);
            })
            ->orderBy('id', 'DESC')
        ;

        return $query->first();
    }

    /**
     * @param array $attributes
     * @return Transaction|Model
     */
    public function create(array $attributes): Transaction
    {
        return $this->getModelClone()->newQuery()->create($attributes);
    }

    public function delete(int $id): void
    {
        $this->getModelClone()->newQuery()->find($id)?->delete();
    }
}
