<?php

declare(strict_types=1);

namespace App\Services\Course\Contracts;

use App\Services\Course\DTOs\GetCourseDTO;

interface CourseServiceInterface
{
    public function getCourse(string $type = ''): array;
}
