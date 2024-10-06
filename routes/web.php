<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'set.locale'], function () {

    Route::get('/setlocale/{locale}', function ($locale) {
        session()->put('locale', $locale);
        return ['lang' => $locale];
    })->name('locale');

    Route::get('/', function () {
        return inertia('Index/Index');
    });

    Route::get('/container/{path}', [App\Http\Controllers\ContainerController::class, 'getImage'])
        ->middleware('auth')
        ->name('container');

    Route::resource('fishing', App\Http\Controllers\FishingController::class)
        ->middleware('auth')
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

    Route::get('login', [App\Http\Controllers\AuthController::class, 'create'])
        ->name('login');
    Route::post('login', [App\Http\Controllers\AuthController::class, 'store'])
        ->name('login.store');
    Route::delete('logout', [App\Http\Controllers\AuthController::class, 'destroy'])
        ->withoutMiddleware(ValidateCsrfToken::class)
        ->name('logout');
});
