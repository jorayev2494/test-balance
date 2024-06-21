<?php

declare(strict_types=1);

namespace App\Services\Course\DTOs;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

readonly class GetCourseDTO implements DTOInterface
{
    private function __construct(
        public string $type
    ) { }

    public static function makeFromRequest(Request $request): static
    {
        return new self(
            $request->query->get('type') ?? ''
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
