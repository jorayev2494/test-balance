<?php

declare(strict_types=1);

namespace App\Models\Contracts;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

abstract class BaseAuthenticatable extends Authenticatable implements JWTSubject
{
    /**
     * @return mixed
     */
    public function getJWTIdentifier(): int
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
