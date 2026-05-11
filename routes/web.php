<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $stats = [
        'users' => \App\Models\User::count(),
        'exercises' => \App\Models\Exercise::count(),
        'routines' => \App\Models\Routine::count(),
        'completed_routines' => \App\Models\RoutineLog::where('user_id', \Illuminate\Support\Facades\Auth::id())->count(),
    ];
    $recentRoutines = \App\Models\Routine::with('creator')->latest()->take(4)->get();
    
    $weeklyPlans = \App\Models\WeeklyPlan::with('routine')
        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->get()
        ->keyBy('day_of_week');

    // Real Volume Chart Data (Last 12 days)
    $chartData = \App\Models\ExerciseLog::where('user_id', auth()->id())
        ->where('log_date', '>=', now()->subDays(12))
        ->selectRaw('log_date, SUM(weight * repetitions) as total_volume')
        ->groupBy('log_date')
        ->orderBy('log_date', 'asc')
        ->get()
        ->pluck('total_volume', 'log_date')
        ->toArray();
    
    // Fill missing days with 0
    $fullChartData = [];
    for ($i = 11; $i >= 0; $i--) {
        $date = now()->subDays($i)->format('Y-m-d');
        $fullChartData[$date] = $chartData[$date] ?? 0;
    }

    // Real Personal Records
    $personalRecords = \App\Models\ExerciseLog::where('user_id', auth()->id())
        ->selectRaw('exercise_id, MAX(weight) as max_weight')
        ->groupBy('exercise_id')
        ->with('exercise:id,name')
        ->orderBy('max_weight', 'desc')
        ->take(3)
        ->get();
    
    return view('dashboard', compact('stats', 'recentRoutines', 'weeklyPlans', 'fullChartData', 'personalRecords'));
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembershipController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    
    // Control de Membresías
    Route::resource('memberships', MembershipController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de Ejercicios (Solo lectura para todos)
    Route::get('exercises', [ExerciseController::class, 'index'])->name('exercises.index');
    Route::get('exercises/{exercise}', [ExerciseController::class, 'show'])->name('exercises.show');

    // Rutas de Rutinas (Solo lectura para todos)
    Route::get('routines', [\App\Http\Controllers\RoutineController::class, 'index'])->name('routines.index');
    Route::get('routines/{routine}', [\App\Http\Controllers\RoutineController::class, 'show'])->name('routines.show');

    // Planificación Semanal
    Route::get('/planner', function () {
        return view('planner.index');
    })->name('planner.index');

    // Mi Progreso
    Route::get('/progress', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        }
        return view('progress.index');
    })->name('progress.index');

    Route::post('/routines/{routine}/complete', function (\App\Models\Routine $routine) {
        \App\Models\RoutineLog::create([
            'user_id' => auth()->id(),
            'routine_id' => $routine->id,
            'completed_at' => now(),
        ]);
        return back()->with('message', '¡Rutina completada! Buen trabajo.');
    })->name('routines.complete');

    Route::get('/progress/routines', function () {
        $logs = \App\Models\RoutineLog::with('routine')
            ->where('user_id', auth()->id())
            ->orderBy('completed_at', 'desc')
            ->get();
        return view('progress.routines', compact('logs'));
    })->name('progress.routines');
});

// Rutas protegidas para Administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    // CRUD completo de Ejercicios
    Route::resource('exercises', ExerciseController::class)->except(['index', 'show']);
    
    // CRUD completo de Rutinas
    Route::resource('routines', \App\Http\Controllers\RoutineController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';
