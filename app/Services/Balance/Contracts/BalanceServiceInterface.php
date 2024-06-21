<?php

declare(strict_types=1);

namespace App\Services\Balance\Contracts;

use App\Models\Transaction;
use App\Services\Balance\DTOs\GetBalanceDTO;

interface BalanceServiceInterface
{
    public function getBalance(int $userId, GetBalanceDTO $getBalanceDTO): ?Transaction;
}
