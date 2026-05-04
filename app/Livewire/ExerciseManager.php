<?php

namespace App\Livewire;

use App\Models\Exercise;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExerciseManager extends Component
{
    use WithFileUploads;

    public $exercises;
    public $exerciseId;
    public $name, $description, $target_muscle, $video_url, $difficulty_level = 'principiante';
    public $image;
    
    public $isModalOpen = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|min:3',
        'target_muscle' => 'required|string',
        'difficulty_level' => 'required|in:principiante,intermedio,avanzado',
        'video_url' => 'nullable|url',
        'image' => 'nullable|image|max:2048', 
    ];

    public function render()
    {
        $this->exercises = Exercise::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('target_muscle', 'like', '%' . $this->search . '%')
            ->get();
            
        return view('livewire.exercise-manager');
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
        $this->exerciseId = null;
        $this->name = '';
        $this->description = '';
        $this->target_muscle = '';
        $this->video_url = '';
        $this->difficulty_level = 'principiante';
        $this->image = null;
    }

    public function store()
    {
        abort_if(!auth()->user()->hasRole('admin'), 403);
        $this->validate();

        $exercise = Exercise::updateOrCreate(['id' => $this->exerciseId], [
            'name' => $this->name,
            'description' => $this->description,
            'target_muscle' => $this->target_muscle,
            'video_url' => $this->video_url,
            'difficulty_level' => $this->difficulty_level,
        ]);

        if ($this->image) {
            // Clear previous media if updating
            if ($this->exerciseId) {
                $exercise->clearMediaCollection('exercises');
            }
            $exercise->addMedia($this->image->getRealPath())
                ->usingFileName($this->image->getClientOriginalName())
                ->toMediaCollection('exercises');
        }

        session()->flash('message', $this->exerciseId ? 'Ejercicio actualizado correctamente.' : 'Ejercicio creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        abort_if(!auth()->user()->hasRole('admin'), 403);
        $exercise = Exercise::findOrFail($id);
        $this->exerciseId = $id;
        $this->name = $exercise->name;
        $this->description = $exercise->description;
        $this->target_muscle = $exercise->target_muscle;
        $this->video_url = $exercise->video_url;
        $this->difficulty_level = $exercise->difficulty_level;

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasRole('admin'), 403);
        Exercise::findOrFail($id)->delete();
        session()->flash('message', 'Ejercicio eliminado.');
    }
}
