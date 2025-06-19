<?php

declare(strict_types=1);

namespace App\Providers;

use App\Traits\SessionFlashMessagesTrait;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    use SessionFlashMessagesTrait;

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
        view()->composer('components.session-flash-messages', fn($view) => $view->with('messages', self::getMessages()));
    }
}
