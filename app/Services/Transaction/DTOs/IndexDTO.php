<?php

declare(strict_types=1);

namespace App\Services\Transaction\DTOs;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

readonly class IndexDTO implements DTOInterface
{
    private function __construct(
        public array $filters
    ) { }

    public static function makeFromRequest(Request $request): static
    {
        return new self(
            $request->query->all('filters')
        );
    }

    public function toArray(): array
    {
        return [
            'filters' => $this->filters,
        ];
    }
}
