<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['prefix' => 'sign-up'], function () {
            Route::get('/', [RegisteredUserController::class, 'create'])->name('register');
            Route::post('/', [RegisteredUserController::class, 'store'])->name('register.store');
        });
        Route::group(['prefix' => 'sign-in'], function () {
            Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
            Route::post('/', [AuthenticatedSessionController::class, 'store'])->name('login.store');
        });
    }); # users
}); # guest

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['as' => 'verification'], function () {
            Route::group(['prefix' => 'email'], function () {
                Route::get('verify', EmailVerificationPromptController::class)->name('.notice');
                Route::get('verify/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('.verify');
                Route::post('verify/send', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('.send');
            }); # email
        }); # verification
        Route::group(['prefix' => 'password'], function () {
            Route::get('confirm', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
            Route::post('confirm', [ConfirmablePasswordController::class, 'store']);
            Route::put('update', [PasswordController::class, 'update'])->name('password.update');
        }); # password
        Route::post('sign-out', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    }); # users
}); # auth

Route::group(['prefix' => 'users'], function () {
    Route::group(['prefix' => 'password', 'as' => 'password'], function () {
        Route::get('/new', [PasswordResetLinkController::class, 'create'])->name('.request');
        Route::post('/new', [PasswordResetLinkController::class, 'store'])->name('.email');
        Route::get('/reset/{token}', [NewPasswordController::class, 'create'])->name('.reset');
        Route::post('/reset', [NewPasswordController::class, 'store'])->name('.store');
    }); # password
}); # users
