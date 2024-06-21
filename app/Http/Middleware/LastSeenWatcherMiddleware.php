<?php

namespace App\Http\Middleware;

use App\Models\Contracts\LastSeenWatcherInterface;
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
        if (auth()->check()) {
            /** @var \App\Models\User $user */
            $user = auth()->user();
            $this->changeAuthUserLastSeenTime($user);
        }

        return $next($request);
    }

    private function changeAuthUserLastSeenTime(LastSeenWatcherInterface $seenWatcher): void
    {
        $seenWatcher->changeLastSeen();
    }
}
