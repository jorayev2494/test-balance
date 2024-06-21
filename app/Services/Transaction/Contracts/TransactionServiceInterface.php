<?php

namespace App\Services\Transaction\Contracts;

use App\Models\Transaction;
use App\Services\Transaction\DTOs\IndexDTO;
use App\Services\Transaction\DTOs\StoreDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TransactionServiceInterface
{
    public function index(IndexDTO $indexDTO): LengthAwarePaginator;

    public function store(StoreDTO $storeDTO): Transaction;

    public function show(int $id): Transaction;

    public function delete(int $id): void;
}
