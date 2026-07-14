<?php

use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('rateio');
});

Route::get('/auth/google', [OAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/groups', [GroupController::class, 'index'])->middleware('auth')->name('groups');

Route::post('/groups', [GroupController::class, 'store'])->middleware('auth')->name('groups.store');

Route::get('/installments', function () {
    return view('installments');
})->middleware('auth')->name('installments');

Route::get('/notifications', function () {
    return view('notifications');
})->middleware('auth')->name('notifications');

Route::get('/settings', [SettingsController::class, 'index'])->middleware('auth')->name('settings');
Route::post('/settings', [SettingsController::class, 'update'])->middleware('auth')->name('settings.update');
Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->middleware('auth')->name('settings.password');
