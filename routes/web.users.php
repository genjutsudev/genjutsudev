<?php

declare(strict_types=1);

use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['prefix' => 'sign-up'], function () {
            Route::get('/', [UserRegistrationController::class, 'create'])->name('register');
            Route::post('/', [UserRegistrationController::class, 'store'])->name('register.store');
        });
        Route::group(['prefix' => 'sign-in'], function () {
            /*Route::get('/', [UserRegistrationController::class, 'create'])->name('login');*/
            /*Route::post('/', [UserRegistrationController::class, 'store'])->name('login.store');*/
        });
    }); # users
}); # guest
