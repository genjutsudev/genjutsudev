<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

require __DIR__ . '/users/web.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/terms', fn() => response()->view('web.sections.terms'))->name('terms');
Route::get('/privacy', fn() => response()->view('web.sections.privacy'))->name('privacy');
Route::get('/copyright', fn() => response()->view('web.sections.copyright'))->name('copyright');
Route::get('/rules', fn() => response()->view('web.sections.rules'))->name('rules');

Route::get('/animes', function () {
    return view('web.sections.animes.index');
})->name('animes');
