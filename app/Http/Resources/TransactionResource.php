<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Transaction $resource
 */
class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'income' => $this->resource->income,
            'amount' => $this->resource->amount,
            'cost' => $this->resource->cost,
            'author' => UserResource::make($this->whenLoaded('author')),
            'created_at' => $this->resource->created_at?->format('d-m-Y H:i:s'),
            'updated_at' => $this->resource->updated_at?->format('d-m-Y H:i:s'),
        ];
    }
}
