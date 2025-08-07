<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\UserUser as User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserEnsureCorrectRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = $request->route('user');

        if ($user && $user->profilelink !== $request->profilelink) {
            return redirect()->back();
        }

        return $next($request);
    }
}
