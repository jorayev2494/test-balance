<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Auth\Contracts\AuthServiceInterface;
use App\Services\Auth\DTOs\LoginDTO;
use App\Services\Auth\DTOs\RegisterDTO;
use Illuminate\Auth\AuthenticationException;

readonly class AuthService implements AuthServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    public function register(RegisterDTO $registerDTO): void
    {
        $this->userRepository->create($registerDTO->toArray());
    }

    public function login(LoginDTO $loginDTO): array
    {
        /** @var string|bool $token */
        if (!$token = auth()->attempt($loginDTO->toArray())) {
            throw new AuthenticationException();
        }

        return $this->makeTokenWithAuthData($token);
    }

    public function logout(): void
    {
        auth()->logout();
    }

    private function makeTokenWithAuthData(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'auth_data' => UserResource::make(auth()->user()),
        ];
    }
}
