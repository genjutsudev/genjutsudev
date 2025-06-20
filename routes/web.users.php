<?php

declare(strict_types=1);

use App\Http\Controllers\UserAuthenticatedController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['prefix' => 'sign-up'], function () {
            Route::get('/', [UserRegistrationController::class, 'create'])->name('register');
            Route::post('/', [UserRegistrationController::class, 'store'])->name('register.store');
        });
        Route::group(['prefix' => 'sign-in'], function () {
            Route::get('/', [UserAuthenticatedController::class, 'create'])->name('login');
            Route::post('/', [UserAuthenticatedController::class, 'store'])->name('login.store');
        });
    }); # users
}); # guest

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['as' => 'verification'], function () {
            Route::group(['prefix' => 'email'], function () {
                /*Route::get('verify', EmailVerificationPromptController::class)->name('.notice');*/
                /*Route::get('verify/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('.verify');*/
                /*Route::post('verify/send', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('.send');*/
            }); # email
        }); # verification
        Route::group(['prefix' => 'password'], function () {
            /*Route::get('confirm', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');*/
            /*Route::post('confirm', [ConfirmablePasswordController::class, 'store']);*/
            /*Route::put('update', [PasswordController::class, 'update'])->name('password.update');*/
        }); # password
        Route::post('sign-out', [UserAuthenticatedController::class, 'destroy'])->name('logout');
    }); # users
}); # auth
