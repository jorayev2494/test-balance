<?php

declare(strict_types=1);

namespace App\Services\Balance;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Services\Balance\Contracts\BalanceServiceInterface;
use App\Services\Balance\DTOs\GetBalanceDTO;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class BalanceService implements BalanceServiceInterface
{
    public function __construct(
        private TransactionRepositoryInterface $transactionRepository
    ) { }

    public function getBalance(int $userId, GetBalanceDTO $getBalanceDTO): Transaction
    {
        $foundTransaction = $this->transactionRepository->getBalance($userId, $getBalanceDTO->startDate, $getBalanceDTO->endDate);

        $foundTransaction ?? throw new BadRequestHttpException('Transaction not found');

        return $foundTransaction;
    }
}
