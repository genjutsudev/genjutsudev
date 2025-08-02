<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\UserEnsureCorrectRedirect;
use App\Http\Middleware\UserEnsureEditOnlySelfAccount;
use App\Http\Middleware\UserUpdateActivityAt;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('web', UserUpdateActivityAt::class);
        $middleware->appendToGroup('auth', Authenticate::class);
        $middleware->alias([
            'access.edit' => UserEnsureEditOnlySelfAccount::class,
            'redirect.profilelink' => UserEnsureCorrectRedirect::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
