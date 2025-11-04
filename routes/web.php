<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota de Exemplo (Dashboard)
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Nossas novas rotas de CRUD
    Route::prefix('admin')->middleware('role:Admin|Gestor')->name('admin.')->group(function () {
        Route::resource('branches', \App\Http\Controllers\Admin\BranchController::class);
        Route::resource('bays', \App\Http\Controllers\Admin\BayController::class);
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->middleware('role:Admin');
    });
});

require __DIR__.'/auth.php';
