<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

readonly abstract class BaseModelRepository
{
    /**
     * @var Model|null $model
     */
    private ?Model $model;

    public function __construct()
    {
        $this->initialize();
    }

    protected abstract function getModelClassName(): string;

    private function initialize(): void
    {
        $this->model = app()->make($this->getModelClassName());
    }

    public function getModelClone(): Model
    {
        return clone $this->model;
    }
}
