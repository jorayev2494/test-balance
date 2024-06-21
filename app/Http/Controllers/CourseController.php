<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\CourseServiceFacade;
use App\Services\Course\Contracts\CourseServiceInterface;
use App\Services\Course\DTOs\GetCourseDTO;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

readonly class CourseController
{
    public function __construct(
        private ResponseFactory $response,
        private CourseServiceInterface $service
    ) { }

    public function getCourse(Request $request): JsonResponse
    {
        $course = $this->service->getCourse($request->query->get('type') ?? '');

        return $this->response->json($course);
    }
}
