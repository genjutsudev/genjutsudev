<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/web.users.php';

// @deprecated
Route::get('/', fn() => 'Hello, World!');

Route::get('/terms', fn() => response()->view('sections.terms'))->name('terms');
Route::get('/privacy', fn() => response()->view('sections.privacy'))->name('privacy');
Route::get('/copyright', fn() => response()->view('sections.copyright'))->name('copyright');
Route::get('/rules', fn() => response()->view('sections.rules'))->name('rules');

Route::get('/animes', function () {
    /*$user = \Illuminate\Support\Facades\Auth::user();
    $type = new \App\Values\UserTypeValue(\App\Enums\UserTypeEnum::from($user->type));
    dd($type->isRegular());*/
    return view('sections.animes.index');
})->name('animes');
