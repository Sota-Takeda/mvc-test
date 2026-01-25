<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => view('welcome'));

/**
 * 公開ルート（誰でも）
 */
Route::get('/test', [TestController::class, 'index']); // 不要なら消す
Route::resource('posts', PostController::class)->except(['show']);

/**
 * 認証必須ルート（ログインしてる人だけ）
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Book CRUD（ログインユーザーのみ）
    Route::resource('books', BookController::class);

    // Profile（Breeze/Jetstream系）
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
