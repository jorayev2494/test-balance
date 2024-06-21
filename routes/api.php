<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CourseController;

Route::group(
    ['prefix' => 'auth', 'controller' => AuthController::class],
    static function (Router $router): void {
        $router->post('/register', 'register')->middleware('guest');
        $router->post('/login', 'login')->middleware('guest');
        $router->post('/logout', 'logout');
    }
);

Route::middleware([
    'auth:api',
])->group(
    static function (Router $router): void {
        $router->apiResource('/transactions', TransactionController::class)
            ->except(['update']);

        $router->group(
            ['prefix' => 'balance', 'controller' => BalanceController::class],
            static function (Router $router): void {
                $router->get('/balance', 'getBalance');
            }
        );

        $router->get('/course', [CourseController::class, 'getCourse']);
    }
);
