<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'throttle:default'])
    ->prefix('dashboard')
    ->group(function () {
        Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
            Route::patch('/{permission}/restore', [PermissionController::class, 'restore'])
                ->name('restore')
                ->withTrashed();
        });
        Route::resource('permissions', PermissionController::class);

        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::patch('/{role}/restore', [RoleController::class, 'restore'])
                ->name('restore')
                ->withTrashed();
        });
        Route::resource('roles', RoleController::class);

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::patch('/{user}/restore', [UserController::class, 'restore'])
                ->name('restore')
                ->withTrashed();
        });
        Route::resource('users', UserController::class);
    });

require __DIR__.'/auth.php';
