<?php

namespace App\Livewire;

use App\Models\Routine;
use App\Models\Exercise;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RoutineManager extends Component
{
    public $routines;
    public $routineId;
    public $name, $description;
    
    // For attaching exercises
    public $availableExercises;
    public $selectedExercises = [];
    
    public $isModalOpen = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|min:3',
        'description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->availableExercises = Exercise::orderBy('name')->get();
    }

    public function render()
    {
        $this->routines = Routine::with('creator', 'exercises')
            ->where('name', 'like', '%' . $this->search . '%')
            ->get();
            
        return view('livewire.routine-manager');
    }

    public function openModal()
    {
        abort_if(!auth()->user()->hasRole('admin'), 403);
        $this->isModalOpen = true;
        $this->resetInputFields();
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetErrorBag();
    }

    private function resetInputFields()
    {
        $this->routineId = null;
        $this->name = '';
        $this->description = '';
        $this->selectedExercises = [];
    }

    public function toggleExercise($exerciseId)
    {
        if (in_array($exerciseId, $this->selectedExercises)) {
            $this->selectedExercises = array_diff($this->selectedExercises, [$exerciseId]);
        } else {
            $this->selectedExercises[] = $exerciseId;
        }
    }

    public function store()
    {
        abort_if(!auth()->user()->hasRole('admin'), 403);
        $this->validate();

        $routine = Routine::updateOrCreate(['id' => $this->routineId], [
            'name' => $this->name,
            'description' => $this->description,
            'creator_id' => $this->routineId ? Routine::find($this->routineId)->creator_id : Auth::id(),
        ]);

        // Sync exercises with basic pivot data (could be expanded later for specific sets/reps)
        $syncData = [];
        foreach ($this->selectedExercises as $exId) {
            $syncData[$exId] = ['sets' => 3, 'reps' => 10, 'rest_time_seconds' => 60];
        }
        $routine->exercises()->sync($syncData);

        session()->flash('message', $this->routineId ? 'Rutina actualizada correctamente.' : 'Rutina creada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        abort_if(!auth()->user()->hasRole('admin'), 403);
        $routine = Routine::with('exercises')->findOrFail($id);
        $this->routineId = $id;
        $this->name = $routine->name;
        $this->description = $routine->description;
        $this->selectedExercises = $routine->exercises->pluck('id')->toArray();

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasRole('admin'), 403);
        Routine::findOrFail($id)->delete();
        session()->flash('message', 'Rutina eliminada.');
    }
}
