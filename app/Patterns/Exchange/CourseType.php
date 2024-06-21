<?php

declare(strict_types=1);

namespace App\Patterns\Exchange;

enum CourseType : string
{
    case XML= 'xml';

    case JSON = 'json';

    case CSV = 'csv';
}
