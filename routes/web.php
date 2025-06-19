<?php

use Illuminate\Support\Facades\Route;

// @deprecated
Route::get('/', fn() => 'Hello, World!');

Route::get('/terms', fn() => response()->view('sections.terms'))->name('terms');
Route::get('/privacy', fn() => response()->view('sections.privacy'))->name('privacy');
Route::get('/copyright', fn() => response()->view('sections.copyright'))->name('copyright');
Route::get('/rules', fn() => response()->view('sections.rules'))->name('rules');

Route::get('/animes', function () {
    return view('sections.animes.index');
})->name('animes');
