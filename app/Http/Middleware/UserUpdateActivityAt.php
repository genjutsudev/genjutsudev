<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateActivityAt
{
    private const INTERVAL = 1;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $now = Carbon::now();
        $expiresAt = $now->copy()->subMinutes(self::INTERVAL);
        $activityAt = Carbon::parse($user->activity_at);

        $keyCache = 'user:' . $user->id . ':online';
        $ttlCache = (int) $expiresAt->diffInSeconds($now);

        Cache::store('redis')->put($keyCache, true, $ttlCache);

        if ($activityAt->lt($expiresAt)) {
            $user->timestamps = false;
            $user->updateQuietly(['activity_at' => $now]);
        }

        return $next($request); // @todo
    }
}
