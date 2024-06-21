<?php

namespace App\Patterns\Exchange\Drivers;

use App\Patterns\Exchange\Contracts\CourseStrategyInterface;

readonly class JSONDriver implements CourseStrategyInterface
{

    private array $result;

    public function __construct()
    {
        $this->result = $this->parseFie('ExchangeRates/course.json');
    }

    public function getCourses(): array
    {
        return $this->result;
    }

    private function parseFie(string $path): array
    {
        $jsonData = file_get_contents(\Storage::path($path));

        return json_decode($jsonData, true);
    }
}
