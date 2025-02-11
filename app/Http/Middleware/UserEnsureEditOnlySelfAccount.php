<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Core\Model\User\Entity\User as EntityUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserEnsureEditOnlySelfAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            abort(403, 'You must be logged in to access this page.');
        }

        /** @var ?User $user */
        $user = $request->route('user');

        // Проверяем, что текущий пользователь пытается редактировать себя
        if ($user && Auth::user()?->id !== $user->id) {
            abort(403, 'You are not authorized to edit this user.');
        }

        return $next($request);
    }
}
