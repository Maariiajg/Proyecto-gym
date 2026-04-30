<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $exercises = Exercise::paginate(10);
        return view('exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request): RedirectResponse
    {
        Exercise::create($request->validated());

        return redirect()->route('exercises.index')
            ->with('success', 'Ejercicio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise): View
    {
        return view('exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise): View
    {
        return view('exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise): RedirectResponse
    {
        $exercise->update($request->validated());

        return redirect()->route('exercises.index')
            ->with('success', 'Ejercicio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise): RedirectResponse
    {
        $exercise->delete();

        return redirect()->route('exercises.index')
            ->with('success', 'Ejercicio eliminado exitosamente.');
    }
}
