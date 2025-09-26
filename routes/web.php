<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\SiteController;
use App\Models\Display;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', [
        'displays' => Display::get(),
    ]);
});

Route::post('search', [SiteController::class, 'lookup'])->name('lookup');

Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});
