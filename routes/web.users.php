<?php

declare(strict_types=1);

use App\Http\Controllers\SSO\ShikimoriCallbackController;
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
use App\Http\Controllers\UserShowListController;
use App\Http\Controllers\UserVerificationEmailController;
use App\Http\Controllers\UserVerifyEmailController;
use App\Http\Middleware\UserPasswordConfirm as RequirePassword;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::group(['prefix' => 'users'], function () {
    Route::group(['prefix' => 'oauth/{driver}', 'as' => 'oauth'], function () {
        Route::get('/', static fn (string $driver) => Socialite::driver($driver)->redirect());
        Route::get('/callback', static fn (string $driver) => app()->call(match ($driver) {
            'shikimori' => ShikimoriCallbackController::class,
            // ... other drivers
            default => throw new InvalidArgumentException("network \"$driver\" is not supported")
        }))->whereIn('driver', ['shikimori'])->name('.callback');
    }); # oauth
});

Route::middleware(['guest'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['prefix' => 'sign-up', 'as' => 'register'], function () {
            Route::get('/', [UserRegistrationController::class, 'create']);
            Route::post('/', [UserRegistrationController::class, 'store'])->name('.store');
        }); # sign-up
        Route::group(['prefix' => 'sign-in', 'as' => 'login'], function () {
            Route::get('/', [UserAuthenticatedController::class, 'create']);
            Route::post('/', [UserAuthenticatedController::class, 'store'])->name('.store');
        }); # sign-in
    }); # users
}); # guest

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['as' => 'verification'], function () {
            Route::group(['prefix' => 'email'], function () {
                Route::get('verify', [UserVerificationEmailController::class, 'show'])->name('.notice');
                Route::post('verify', [UserVerificationEmailController::class, 'store'])->middleware('throttle:6,1')->name('.send');
                Route::get('verify/{id}/{hash}', [UserVerifyEmailController::class, 'store'])->middleware(['signed', 'throttle:6,1'])->name('.verify');
            }); # email
        }); # verification
        Route::group(['prefix' => 'password', 'as' => 'password'], function () {
            Route::group(['prefix' => 'confirm', 'as' => '.confirm'], function () {
                Route::get('/', [UserPasswordConfirmController::class, 'show']);
                Route::post('/', [UserPasswordConfirmController::class, 'store'])->name('.store');
            }); # confirm
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
    Route::get('/', [UserController::class, 'index']);
    Route::group(['prefix' => '{user:nid}'], function () {
        Route::get('/', [UserShowController::class, 'redirect'])->name('.redirect');
        Route::group(['prefix' => '/{profilelink}', 'middleware' => ['redirect.profilelink']], function () {
            Route::group(['as' => '.show'], function () {
                Route::get('/', [UserShowController::class, 'show']);
                Route::group(['prefix' => 'lists', 'as' => '.lists'], function () {
                    Route::get('/anime', [UserShowListController::class, 'anime'])->name('.anime');
                }); # lists
                Route::get('/collections', [UserShowController::class, 'collections'])->name('.collections');
                Route::get('/featured', [UserShowController::class, 'featured'])->name('.featured');
                Route::get('/tracked', [UserShowController::class, 'tracked'])->name('.tracked');
            }); # show
            Route::group(['prefix' => 'edit', 'as' => '.edit', 'middleware' => ['auth', 'access.edit']], function () {
                Route::get('/', [UserEditController::class, 'redirect'])->name('.redirect');
                Route::group(['prefix' => 'account', 'as' => '.account'], function () {
                    Route::get('/', [UserEditAccountController::class, 'show']);
                    Route::put('/', [UserEditAccountController::class, 'update'])->name('.update');
                }); # account
                Route::group(['prefix' => 'profilename', 'as' => '.profilename'], function () {
                    Route::get('/', [UserEditProfilenameController::class, 'show']);
                    Route::put('/', [UserEditProfilenameController::class, 'update'])->name('.update');
                }); # profilename
                Route::group(['prefix' => 'profilelink', 'as' => '.profilelink'], function () {
                    Route::get('/', [UserEditProfilelinkController::class, 'show']);
                    Route::put('/', [UserEditProfilelinkController::class, 'update'])->name('.update');
                }); # profilelink
                Route::group(['prefix' => 'birthday', 'as' => '.birthday'], function () {
                    Route::get('/', [UserEditBirthdayController::class, 'show']);
                    Route::put('/', [UserEditBirthdayController::class, 'update'])->name('.update');
                }); # birthday
                Route::group(['prefix' => 'password', 'as' => '.password', 'middleware' => RequirePassword::class], function () {
                    Route::get('/', [UserEditPasswordController::class, 'show']);
                    Route::put('/', [UserEditPasswordController::class, 'update'])->name('.update');
                }); # password
                Route::delete('/{driver}/{identity}', [UserEditAccountController::class, 'detachNetwork'])->name('.network.detach');
            }); # edit
        });
    });
}); # users
