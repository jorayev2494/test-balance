<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollectionResource extends ResourceCollection
{
    /** @var string $collects */
    public $collects = TransactionResource::class;

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resource->toArray($request);
    }
}
