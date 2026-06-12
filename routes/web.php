<?php

use App\Http\Controllers\Auth\OAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('rateio');
});

Route::get('/auth/google', [OAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/groups', function () {
    return view('groups');
})->middleware('auth')->name('groups');

Route::get('/installments', function () {
    return view('installments');
})->middleware('auth')->name('installments');

Route::get('/notifications', function () {
    return view('notifications');
})->middleware('auth')->name('notifications');

Route::get('/settings', function () {
    return view('settings');
})->middleware('auth')->name('settings');
