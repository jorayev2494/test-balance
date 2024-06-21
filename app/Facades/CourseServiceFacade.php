<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CourseServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'course_service_facade';
    }
}
