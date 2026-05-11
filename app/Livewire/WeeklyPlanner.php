<?php

namespace App\Livewire;

use App\Models\Routine;
use App\Models\WeeklyPlan;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WeeklyPlanner extends Component
{
    public $userId;
    public $days = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
    public $routines;
    
    // state for editing
    public $editingDay = null;
    public $selectedRoutine = null;

    // Computed property for the user to avoid serialization issues if possible
    public function getUserProperty()
    {
        return User::findOrFail($this->userId);
    }

    public function mount($userId = null)
    {
        $this->userId = $userId ?: Auth::id();
        
        // Security check
        if ($this->userId != Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $this->routines = Routine::orderBy('name')->get();
    }

    public function render()
    {
        $plans = WeeklyPlan::with('routine')
            ->where('user_id', $this->userId)
            ->get()
            ->keyBy('day_of_week');

        return view('livewire.weekly-planner', [
            'plans' => $plans,
            'user' => $this->user // Using the computed property/method
        ]);
    }

    public function editDay($day)
    {
        if ($this->userId != Auth::id() && !Auth::user()->hasRole('admin')) {
            return;
        }

        $this->editingDay = $day;
        
        $plan = WeeklyPlan::where('user_id', $this->userId)
            ->where('day_of_week', $day)
            ->first();
            
        $this->selectedRoutine = $plan ? $plan->routine_id : '';
    }

    public function saveDay()
    {
        if ($this->userId != Auth::id() && !Auth::user()->hasRole('admin')) {
            return;
        }

        if ($this->selectedRoutine) {
            WeeklyPlan::updateOrCreate(
                ['user_id' => $this->userId, 'day_of_week' => $this->editingDay],
                ['routine_id' => $this->selectedRoutine]
            );
        } else {
            WeeklyPlan::where('user_id', $this->userId)
                ->where('day_of_week', $this->editingDay)
                ->delete();
        }

        $this->editingDay = null;
        $this->selectedRoutine = null;
        
        session()->flash('message', 'Planificación actualizada.');
    }
    
    public function cancelEdit()
    {
        $this->editingDay = null;
        $this->selectedRoutine = null;
    }

    // Helper for the view to get user name
    public function getUser()
    {
        return User::find($this->userId);
    }
}
