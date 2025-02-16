<?php

declare(strict_types=1);

namespace App\Providers;

use App\Traits\SessionFlashMessages;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    use SessionFlashMessages;

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
        view()->composer('components.session-flash-messages', function ($view) {
            return $view->with('messages', self::getMessages());
        });
    }
}
