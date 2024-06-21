<?php

namespace App\Repositories\Contracts;

use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TransactionRepositoryInterface
{
    public function paginate(int $authorId, array $filters = []): LengthAwarePaginator;

    public function find(int $id): ?Transaction;

    public function getCurrentBalance(int $authorId): ?Transaction;

    public function getBalance(int $authorId, string $startDate = null, string $endDate = null): ?Transaction;

    public function create(array $attributes): Transaction;

    public function delete(int $id): void;
}
