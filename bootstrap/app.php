<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        /** @see https://benjamincrozat.com/customize-middleware-laravel-11 **/
        $middleware->redirectGuestsTo(static fn (): null => null);
        $middleware->api([
            'last_seen_watcher' => \App\Http\Middleware\LastSeenWatcherMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->renderable(static function (\Illuminate\Auth\AuthenticationException $ex, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $ex->getMessage(),
                ], Response::HTTP_UNAUTHORIZED);
            }
        });

        $exceptions->renderable(static function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $ex, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $ex->getMessage(),
                ], Response::HTTP_FORBIDDEN);
            }
        });

        $exceptions->renderable(static function (\Illuminate\Validation\ValidationException $ex, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Validation exception',
                    'errors' => $ex->validator->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        });

        $exceptions->renderable(static function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $ex, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $ex->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $exceptions->renderable(static function (\Symfony\Component\HttpKernel\Exception\BadRequestHttpException $ex, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $ex->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $exceptions->renderable(static function (\Exception $ex, Request $request) {
            if ($request->is('api/*')) {
                dd($ex);
                return response()->json([
                    'message' => $ex->getMessage(),
                ], Response::HTTP_BAD_REQUEST);
            }
        });

    })->create();
