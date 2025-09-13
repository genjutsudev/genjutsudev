<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Traits\SessionFlashMessagesTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    use SessionFlashMessagesTrait;

    /**
     * Redirect the user if they are not authenticated.
     *
     * @param Request $request
     * @return string|void|null
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
            // @todo i18n "Available only to authorized users."
            self::info('Доступно только авторизованным пользователям.');
            return route('animes'); // @todo: changed route
        }
    }
}
