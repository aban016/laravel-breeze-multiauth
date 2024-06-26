<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
// Route::get('/agent/dashboard', [AgentController::class, 'dashboard']);
// Route::get('/user/dashboard', [UserController::class, 'dashboard']);

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});

Route::middleware(['role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard']);
});

Route::middleware(['role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'dashboard']);
});


require __DIR__.'/auth.php';
