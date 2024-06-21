<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\TransactionStoreTransactionRequest;
use App\Http\Resources\Collections\TransactionCollectionResource;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Repositories\Filters\FiltersOperatorMapper;
use App\Services\Transaction\Contracts\TransactionServiceInterface;
use App\Services\Transaction\DTOs\IndexDTO;
use App\Services\Transaction\DTOs\StoreDTO;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class TransactionController
{
    public function __construct(
        private ResponseFactory $response,
        private TransactionServiceInterface $service
    ) { }

    public function index(Request $request): JsonResponse
    {
        $result = $this->service->index(IndexDTO::makeFromRequest($request));

        return $this->response->json(
            TransactionCollectionResource::make($result)
        );
    }

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $lastTransaction = $this->service->store(StoreDTO::makeFromRequest($request));

        return $this->response->json(
            TransactionResource::make($lastTransaction),
            Response::HTTP_CREATED
        );
    }

    public function show(int $id): JsonResponse
    {
        return $this->response->json(
            TransactionResource::make($this->service->show($id))
        );
    }

    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return $this->response->noContent();
    }
}
