<?php

namespace App\Providers;

use App\Models\UserUser as User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Noilty\SocialiteProviders\Shikimori\Provider as ShikimoriProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);

        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('shikimori', ShikimoriProvider::class);
        });
    }
}
