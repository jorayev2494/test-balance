<?php

declare(strict_types=1);

namespace App\Services\Auth\DTOs;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

readonly class RegisterDTO implements DTOInterface
{
    private function __construct(
        public string $email,
        public string $password
    ) { }

    public static function makeFromRequest(Request $request): static
    {
        return new self(
            $request->get('email'),
            $request->get('password')
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
