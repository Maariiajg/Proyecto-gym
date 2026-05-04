<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\ExerciseController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de Ejercicios
    Route::resource('exercises', ExerciseController::class);

    // Rutas de Usuarios (Placeholder)
    Route::get('/users', function() {
        return view('dashboard'); // Placeholder until UserController is created
    })->name('users.index');
});

require __DIR__.'/auth.php';
