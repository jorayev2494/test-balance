<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\BaseModelRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

readonly class UserRepository extends BaseModelRepository implements UserRepositoryInterface
{
    protected function getModelClassName(): string
    {
        return User::class;
    }

    /**
     * @param array $attributes
     * @return User|Model
     */
    public function create(array $attributes): User
    {
        return $this->getModelClone()->newQuery()->create($attributes);
    }
}
