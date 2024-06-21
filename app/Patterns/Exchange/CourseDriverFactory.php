<?php

declare(strict_types=1);

namespace App\Patterns\Exchange;

use App\Patterns\Exchange\Contracts\CourseStrategyInterface;
use App\Patterns\Exchange\Drivers\CSVDriver;
use App\Patterns\Exchange\Drivers\JSONDriver;
use App\Patterns\Exchange\Drivers\XMLDriver;

class CourseDriverFactory
{
    public static function make(CourseType $type): CourseStrategyInterface
    {
        return match ($type) {
            CourseType::XML => new XMLDriver(),
            CourseType::JSON => new JSONDriver(),
            CourseType::CSV => new CSVDriver(),
        };
    }
}
