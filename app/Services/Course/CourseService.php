<?php

declare(strict_types=1);

namespace App\Services\Course;

use App\Patterns\Exchange\Contracts\CourseStrategyInterface;
use App\Patterns\Exchange\CourseDriverFactory;
use App\Patterns\Exchange\CourseType;
use App\Services\Course\Contracts\CourseServiceInterface;
use App\Services\Course\DTOs\GetCourseDTO;

readonly class CourseService implements CourseServiceInterface
{
    public function getCourse(string $type = ''): array
    {
        $courseType = CourseType::tryFrom($type) ?? config('course.default_driver_type');

        /** @var CourseStrategyInterface $course */
        $course = \Cache::remember(
            "course-$courseType->value",
            now()->addMinutes(config('course.cache_ttl_in_minutes')),
            static fn () => CourseDriverFactory::make($courseType)
        );

        return $course->getCourses();
    }
}
