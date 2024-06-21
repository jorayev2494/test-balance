<?php

namespace App\Patterns\Exchange\Drivers;

use App\Patterns\Exchange\Contracts\CourseStrategyInterface;

readonly class CSVDriver implements CourseStrategyInterface
{
    private array $result;

    public function __construct()
    {
        $this->result = $this->parseFie('ExchangeRates/course.csv');
    }

    public function getCourses(): array
    {
        return $this->result;
    }

    private function parseFie(string $path): array
    {
        $csvData = file_get_contents(\Storage::path($path));
        $lines = array_filter(explode(PHP_EOL, $csvData));

        $res = [];
        foreach ($lines as $line) {
            [$currency, $value] = str_getcsv($line);
            $res[$currency] = $value;
        }

        return $res;
    }
}
