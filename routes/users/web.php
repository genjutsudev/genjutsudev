<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEditAccountController;
use App\Http\Controllers\UserEditController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/oauth.php';

Route::group([
    'prefix' => 'users',
    'as' => 'users',
], function () {
    Route::get('/', action: [UserController::class, 'index']);
    Route::group(['prefix' => '{user:uid}'], function () {
        Route::get('/', [UserController::class, 'redirect'])->name('.redirect');
        Route::group(['prefix' => '/{profilelink}', 'as' => '.show', 'middleware' => ['redirect.profilelink']], function () {
            Route::get('/', [UserController::class, 'show']);
            Route::group(['prefix' => 'edit', 'as' => '.edit', 'middleware' => ['auth', 'access.edit']], function () {
                Route::get('/', [UserEditController::class, 'redirect'])->name('.redirect');
                Route::group(['prefix' => 'account', 'as' => '.account'], function () {
                    Route::get('/', [UserEditAccountController::class, 'show']);
                    Route::put('/', [UserEditAccountController::class, 'update'])->name('.update');
                });
            });
        });
    });
});
