<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Transaction $resource
 */
class BalanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'income' => $this->resource->income,
            'amount' => $this->resource->amount,
            'cost' => $this->resource->cost,
        ];
    }
}
