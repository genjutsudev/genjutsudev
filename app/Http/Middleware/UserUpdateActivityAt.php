<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateActivityAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return $next($request);
        }

        /** @var User $user */
        $user = Auth::user();
        $now = Carbon::now();
        $expiresAt = $now->copy()->subMinutes(5);

        $keyCache = 'user:' . $user->id . ':online';
        $ttlCache = $expiresAt->diffInSeconds($now);

        Cache::store('redis')->put($keyCache, true, $ttlCache);

        if ($user->activity_at->lt($expiresAt)) {
            $user->activity_at = $now;
            $user->timestamps = false;
            $user->save();
        }

        return $next($request);
    }
}
