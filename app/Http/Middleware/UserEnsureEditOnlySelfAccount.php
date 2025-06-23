<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserEnsureEditOnlySelfAccount
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            abort(403, 'You must be logged in to access this page.'); // @todo i18n
        }

        /** @var ?User $user */
        $user = $request->route('user');

        // Проверяем, что текущий пользователь пытается редактировать себя
        if ($user && Auth::user()?->id !== $user->id) {
            abort(403, 'You are not authorized to edit this user.'); // @todo i18n
        }

        return $next($request);
    }
}
