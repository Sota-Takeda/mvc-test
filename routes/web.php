<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'index']);

Route::resource('posts', PostController::class)->except(['show']);

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
});

require __DIR__.'/auth.php';
