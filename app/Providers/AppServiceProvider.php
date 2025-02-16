<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Sajya\Client\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, fn (): Client => new Client(
            Http::baseUrl(env('API_HOST') . '/rpc/v1')->withHeaders([
                'Authorization' => 'Bearer ' . env('BEARER_TOKEN'),
                'Accept' => 'application/json',
            ])
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
