<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\Contracts\AuthServiceInterface;
use App\Services\Auth\DTOs\LoginDTO;
use App\Services\Auth\DTOs\RegisterDTO;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class AuthController
{
    public function __construct(
        private ResponseFactory $response,
        private AuthServiceInterface $service
    ) { }

    public function register(RegisterRequest $request): Response
    {
        $this->service->register(RegisterDTO::makeFromRequest($request));

        return $this->response->noContent(Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $authData = $this->service->login(LoginDTO::makeFromRequest($request));

        return $this->response->json($authData);
    }

    public function logout(): Response
    {
        $this->service->logout();

        return $this->response->noContent(Response::HTTP_ACCEPTED);
    }
}
