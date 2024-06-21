<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\Transaction\TransactionCreatedEvent;
use App\Listeners\Transaction\TransactionCreatedLoggerListener;
use App\Listeners\Transaction\TransactionCreatedSendMailListener;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Services\Auth\AuthService;
use App\Services\Auth\Contracts\AuthServiceInterface;
use App\Services\Balance\BalanceService;
use App\Services\Balance\Contracts\BalanceServiceInterface;
use App\Services\Course\Contracts\CourseServiceInterface;
use App\Services\Course\CourseService;
use App\Services\Transaction\Contracts\TransactionServiceInterface;
use App\Services\Transaction\TransactionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Services
        $this->app->singleton(AuthServiceInterface::class, AuthService::class);
        $this->app->singleton(TransactionServiceInterface::class, TransactionService::class);
        $this->app->singleton(BalanceServiceInterface::class, BalanceService::class);
        $this->app->singleton(CourseServiceInterface::class, CourseService::class);

        // Facades
        $this->app->bind('course_service_facade', CourseService::class);

        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // \DB::listen(function ($query) {
        //     // $query->sql;
        //     // $query->bindings;
        //     // $query->time;
        // });

        \Event::listen(
            TransactionCreatedEvent::class, [
                TransactionCreatedSendMailListener::class,
                TransactionCreatedLoggerListener::class,
            ]
        );
    }
}
