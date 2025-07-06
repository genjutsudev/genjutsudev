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
            self::info('Available only to authorized users.'); // @todo i18n
            return route('animes'); // @todo: changed route
        }
    }
}
