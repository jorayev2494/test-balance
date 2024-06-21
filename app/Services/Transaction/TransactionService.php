<?php

declare(strict_types=1);

namespace App\Services\Transaction;

use App\Events\Transaction\TransactionCreatedEvent;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Services\Transaction\Contracts\TransactionServiceInterface;
use App\Services\Transaction\DTOs\IndexDTO;
use App\Services\Transaction\DTOs\StoreDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class TransactionService implements TransactionServiceInterface
{

    public function __construct(
        private TransactionRepositoryInterface $repository
    ) { }

    public function index(IndexDTO $indexDTO): LengthAwarePaginator
    {
        return $this->repository->paginate(auth()->id(), $indexDTO->filters);
    }

    public function store(StoreDTO $storeDTO): Transaction
    {
        /** @var Transaction $currentBalance */
        $currentBalance = $this->repository->getCurrentBalance(auth()->id());

        $currentAmount = $currentBalance->amount ?? 0;
        if ($storeDTO->income > 0) {
            $currentAmount += $storeDTO->income;
        }

        if ($storeDTO->cost > 0) {
            if ($currentAmount < $storeDTO->cost) {
                throw new BadRequestHttpException('There are not enough funds on the balance sheet');
            }

            $currentAmount -= $storeDTO->cost;
        }

        $lastTransaction = $this->saveTransaction($storeDTO, $currentAmount);
        // event(new TransactionCreatedEvent($currentBalance));

        return $lastTransaction;
    }

    public function show(int $id): Transaction
    {
        /** @var Transaction|null $foundTransaction */
        $foundTransaction = $this->repository->find($id);

        $foundTransaction ?? throw new ModelNotFoundException('Transaction not found');

        Gate::authorize('view', $foundTransaction);

        return $foundTransaction->load('author');
    }

    public function delete(int $id): void
    {
        $foundTransaction = $this->repository->find($id);

        $foundTransaction ?? throw new ModelNotFoundException('Transaction not found');

        Gate::authorize('delete', $foundTransaction);

        $this->repository->delete($id);
    }

    private function saveTransaction(StoreDTO $storeDTO, float $currentAmount): Transaction
    {
        $attributes = array_merge(
            $storeDTO->toArray(),
            [
                'amount' => $currentAmount,
                'author_id' => auth()->id(),
            ]
        );

        return $this->repository->create($attributes);
    }
}
