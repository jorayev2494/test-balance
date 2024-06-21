<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\BalanceResource;
use App\Services\Balance\Contracts\BalanceServiceInterface;
use App\Services\Balance\DTOs\GetBalanceDTO;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

readonly class BalanceController
{
    public function __construct(
        private ResponseFactory $response,
        private BalanceServiceInterface $service
    ) { }

    public function getBalance(Request $request): JsonResponse
    {
        return $this->response->json(
            BalanceResource::make(
                $this->service->getBalance(
                    auth()->id(),
                    GetBalanceDTO::makeFromRequest($request)
                )
            )
        );
    }
}
