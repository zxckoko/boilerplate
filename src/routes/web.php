<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('articles/ajax', [ArticleController::class, 'ajax'])->name('articles.ajax');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
    Route::resource('articles', ArticleController::class);
});

require __DIR__.'/auth.php';
