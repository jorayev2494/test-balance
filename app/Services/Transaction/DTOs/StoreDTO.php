<?php

declare(strict_types=1);

namespace App\Services\Transaction\DTOs;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

readonly class StoreDTO implements DTOInterface
{
    private function __construct(
        public string $title,
        public ?float $income,
        public ?float $cost
    ) { }

    public static function makeFromRequest(Request $request): static
    {
        return new self(
            $request->get('title'),
            $request->float('income', null),
            $request->float('cost', null)
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'income' => $this->income,
            'cost' => $this->cost
        ];
    }
}
