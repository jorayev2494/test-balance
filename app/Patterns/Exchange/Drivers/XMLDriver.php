<?php

declare(strict_types=1);

namespace App\Patterns\Exchange\Drivers;

use App\Patterns\Exchange\Contracts\CourseStrategyInterface;

readonly class XMLDriver implements CourseStrategyInterface
{
    private array $result;

    public function __construct()
    {
        $this->result = $this->parseFile('ExchangeRates/course.xml');
    }

    public function getCourses(): array
    {
        return $this->result;
    }

    private function parseFile(string $path): array
    {
        $xmlCourse = simplexml_load_file(\Storage::path($path));

        return (array) $xmlCourse->children();
    }
}
