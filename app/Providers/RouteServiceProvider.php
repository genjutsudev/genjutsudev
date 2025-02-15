<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        # https://laracasts.com/discuss/channels/laravel/check-route-is-named-with-parameter
        Route::macro('isWith', function (...$parameters): bool {
            $currentUrl = url()->current();

            foreach ($parameters as $parameter) {
                $routeUrl = is_array($parameter)
                    ? route($parameter[0], $parameter[1] ?? [])
                    : route($parameter);

                if ($currentUrl === $routeUrl) {
                    return true;
                }
            }

            return false;
        });
    }
}
