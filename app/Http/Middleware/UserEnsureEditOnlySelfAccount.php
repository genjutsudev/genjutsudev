<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\UserUser as User;
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
            // @todo i18n "You must be logged in to access this page."
            abort(403, 'Для доступа к этой странице вам необходимо войти в систему.');
        }

        /** @var ?User $user */
        $user = $request->route('user');
        if ($user && Auth::user()?->id !== $user->id) {
            // Проверяем, что текущий пользователь пытается редактировать себя
            // @todo i18n "You are not authorized to edit this user."
            abort(403, 'У вас нет прав для редактирования этого пользователя.');
        }

        return $next($request);
    }
}
