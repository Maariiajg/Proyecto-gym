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
            ->latest()
            ->get();
            
        return view('livewire.routine-manager');
    }

    public function openModal()
    {
        // Clients can also create routines
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
        $this->validate();

        // If editing, check ownership
        if ($this->routineId) {
            $routine = Routine::findOrFail($this->routineId);
            abort_if(!auth()->user()->hasRole('admin') && $routine->creator_id !== auth()->id(), 403);
        }

        $routine = Routine::updateOrCreate(['id' => $this->routineId], [
            'name' => $this->name,
            'description' => $this->description,
            'creator_id' => $this->routineId ? Routine::find($this->routineId)->creator_id : Auth::id(),
        ]);

        // Sync exercises with basic pivot data
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
        $routine = Routine::with('exercises')->findOrFail($id);
        
        // Clients can only edit their own routines
        abort_if(!auth()->user()->hasRole('admin') && $routine->creator_id !== auth()->id(), 403);

        $this->routineId = $id;
        $this->name = $routine->name;
        $this->description = $routine->description;
        $this->selectedExercises = $routine->exercises->pluck('id')->toArray();

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        $routine = Routine::findOrFail($id);
        
        // Clients can only delete their own routines
        abort_if(!auth()->user()->hasRole('admin') && $routine->creator_id !== auth()->id(), 403);

        $routine->delete();
        session()->flash('message', 'Rutina eliminada.');
    }
}
