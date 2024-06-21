<?php

declare(strict_types=1);

namespace App\Services\Balance\DTOs;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

readonly class GetBalanceDTO implements DTOInterface
{
    private function __construct(
        public ?string $startDate = null,
        public ?string $endDate = null,
    ) { }

    public static function makeFromRequest(Request $request): static
    {
        return new self(
            $request->query->get('start_date'),
            $request->query->get('end_date')
        );
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ];
    }
}
