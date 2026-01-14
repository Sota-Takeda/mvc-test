<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;

Route::resource('books', BookController::class);

Route::get('/test', [TestController::class, 'index']);

Route::resource('posts', PostController::class)->except(['show']);

Route::get('/', function () {
    return view('welcome');
});
