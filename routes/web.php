<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index/Index');
});

Route::get('/container/{path}', [App\Http\Controllers\ContainerController::class, 'getImage'])
    ->name('container');

Route::resource('fishing', App\Http\Controllers\FishingController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
