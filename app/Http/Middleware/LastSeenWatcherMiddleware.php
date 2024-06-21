<?php

namespace App\Http\Middleware;

use App\Models\Contracts\LastSeenWatcherInterface;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LastSeenWatcherMiddleware
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|LastSeenWatcherInterface $user */
        if (($user = auth()->user()) instanceof LastSeenWatcherInterface) {
            $user->changeLastSeen();
        }

        return $next($request);
    }
}
