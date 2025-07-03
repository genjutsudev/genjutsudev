<?php

declare(strict_types=1);

use App\Http\Controllers\UserAuthenticatedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEditAccountController;
use App\Http\Controllers\UserEditBirthdayController;
use App\Http\Controllers\UserEditController;
use App\Http\Controllers\UserEditPasswordController;
use App\Http\Controllers\UserEditProfilelinkController;
use App\Http\Controllers\UserEditProfilenameController;
use App\Http\Controllers\UserPasswordConfirmController;
use App\Http\Controllers\UserPasswordResetController;
use App\Http\Controllers\UserPasswordForgotController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\UserShowController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['prefix' => 'sign-up'], function () {
            Route::get('/', [UserRegistrationController::class, 'create'])->name('register');
            Route::post('/', [UserRegistrationController::class, 'store'])->name('register.store');
        }); # sign-up
        Route::group(['prefix' => 'sign-in'], function () {
            Route::get('/', [UserAuthenticatedController::class, 'create'])->name('login');
            Route::post('/', [UserAuthenticatedController::class, 'store'])->name('login.store');
        }); # sign-in
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
        Route::group(['prefix' => 'password', 'as' => 'password'], function () {
            Route::get('confirm', [UserPasswordConfirmController::class, 'show'])->name('.confirm');
            Route::post('confirm', [UserPasswordConfirmController::class, 'store'])->name('.confirm');
            Route::put('update', [UserEditPasswordController::class, 'update'])->name('.update');
        }); # password
        Route::post('sign-out', [UserAuthenticatedController::class, 'destroy'])->name('logout');
    }); # users
}); # auth

Route::group(['prefix' => 'users'], function () {
    Route::group(['prefix' => 'password', 'as' => 'password'], function () {
        Route::get('/new', [UserPasswordForgotController::class, 'create'])->name('.request');
        Route::post('/new', [UserPasswordForgotController::class, 'store'])->name('.email');
        Route::get('/reset/{token}', [UserPasswordResetController::class, 'create'])->name('.reset');
        Route::post('/reset', [UserPasswordResetController::class, 'store'])->name('.store');
    }); # password
}); # users

Route::group(['prefix' => 'users', 'as' => 'users'], function () {
    Route::get('/', action: [UserController::class, 'index']);
    Route::group(['prefix' => '{user:nid}'], function () {
        Route::get('/', [UserShowController::class, 'redirect'])->name('.redirect');
        Route::group(['prefix' => '/{profilelink}', 'middleware' => ['redirect.profilelink']], function () {
            Route::group(['as' => '.show'], function () {
                Route::get('/', [UserShowController::class, 'show']);
                Route::get('/collections', [UserShowController::class, 'collections'])->name('.collections');
                Route::get('/featured', [UserShowController::class, 'featured'])->name('.featured');
                Route::get('/tracked', [UserShowController::class, 'tracked'])->name('.tracked');
            }); # show
            Route::group(['prefix' => 'edit', 'as' => '.edit', 'middleware' => ['auth', 'access.edit']], function () {
                Route::get('/', [UserEditController::class, 'redirect'])->name('.redirect');
                Route::group(['prefix' => 'account', 'as' => '.account'], function () {
                    Route::get('/', [UserEditAccountController::class, 'show']);
                    Route::put('/', [UserEditAccountController::class, 'update']);
                }); # account
                Route::group(['prefix' => 'profilename', 'as' => '.profilename'], function () {
                    Route::get('/', [UserEditProfilenameController::class, 'show']);
                    Route::put('/', [UserEditProfilenameController::class, 'update']);
                }); # profilename
                Route::group(['prefix' => 'profilelink', 'as' => '.profilelink'], function () {
                    Route::get('/', [UserEditProfilelinkController::class, 'show']);
                    Route::put('/', [UserEditProfilelinkController::class, 'update']);
                }); # profilelink
                Route::group(['prefix' => 'birthday', 'as' => '.birthday'], function () {
                    Route::get('/', [UserEditBirthdayController::class, 'show']);
                    Route::put('/', [UserEditBirthdayController::class, 'update']);
                }); # birthday
                Route::group(['prefix' => 'password', 'as' => '.password', 'middleware' => ['password.confirm']], function () {
                    Route::get('/', [UserEditPasswordController::class, 'show']);
                    Route::put('/', [UserEditPasswordController::class, 'update']);
                }); # password
            }); # edit
        });
    });
}); # users
