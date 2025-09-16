<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\UserUser as User;
use Closure;
use Exception;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

readonly class UserPasswordConfirm
{
    public function __construct(
        private RequirePassword $requirePassword
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldSkipRequirePassword()) {
            return $next($request);
        }

        return $this->requirePassword->handle($request, $next);
    }

    private function shouldSkipRequirePassword(): bool
    {
        return ! $this->isAuth() || ! $this->hasEmail();
    }

    private function isAuth(): bool
    {
        return Auth::check();
    }

    private function hasEmail(): bool
    {
        $user = Auth::user();
        return $user instanceof User && ! empty($user->email);
    }
}
