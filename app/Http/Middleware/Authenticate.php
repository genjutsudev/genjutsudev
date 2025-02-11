<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Traits\SessionFlashMessages;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use SessionFlashMessages;

    /**
     * Redirect the user if they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            self::info('Доступно только авторизованным пользователем.');
            return route('animes'); // TODO: Changed route
        }
    }
}
