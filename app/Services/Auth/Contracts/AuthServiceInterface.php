<?php

namespace App\Services\Auth\Contracts;

use App\Services\Auth\DTOs\LoginDTO;
use App\Services\Auth\DTOs\RegisterDTO;

interface AuthServiceInterface
{
    public function register(RegisterDTO $registerDTO): void;

    public function login(LoginDTO $loginDTO): array;

    public function logout(): void;
}
