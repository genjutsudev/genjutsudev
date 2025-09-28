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
        /** @var User $user */
        $user = Auth::user();
        return ! $this->isAuth() || (! $this->hasEmail($user) && ! $this->hasPassword($user));
    }

    private function isAuth(): bool
    {
        return Auth::check();
    }

    private function hasEmail(User $user): bool
    {
        return ! empty($user->email);
    }

    private function hasPassword(User $user): bool
    {
        return ! empty($user->password);
    }
}
