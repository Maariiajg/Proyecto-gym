<?php

namespace App\Livewire;

use App\Models\Exercise;
use App\Models\ExerciseLog;
use App\Models\Routine;
use App\Models\RoutineLog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProgress extends Component
{
    public $logId;
    public $exercises;
    public $routines;
    public $selectedRoutineId;
    public $selectedExerciseId;
    public $weight, $repetitions, $time_spent_seconds, $log_date;
    public $logs = [];
    public $chartData = [];
    public $isEditMode = false;
    public $loggedToday = [];

    protected $rules = [
        'selectedExerciseId' => 'required|exists:exercises,id',
        'weight' => 'required|numeric|min:0',
        'repetitions' => 'required|integer|min:0',
        'time_spent_seconds' => 'nullable|integer|min:0',
        'log_date' => 'required|date',
    ];

    public function mount()
    {
        $this->routines = Routine::orderBy('name')->get();
        $this->exercises = Exercise::orderBy('name')->get();
        $this->log_date = date('Y-m-d');
        $this->loadLoggedToday();
        
        if ($this->exercises->count() > 0) {
            $this->selectedExerciseId = $this->exercises->first()->id;
            $this->loadLogs();
        }
    }

    public function updatedSelectedRoutineId()
    {
        if ($this->selectedRoutineId) {
            $routine = Routine::with('exercises')->find($this->selectedRoutineId);
            $this->exercises = $routine->exercises;
            $this->selectedExerciseId = $this->exercises->first()->id ?? null;
        } else {
            $this->exercises = Exercise::orderBy('name')->get();
        }
        $this->loadLogs();
    }

    public function updatedLogDate()
    {
        $this->loadLoggedToday();
    }

    public function loadLoggedToday()
    {
        $this->loggedToday = ExerciseLog::where('user_id', Auth::id())
            ->where('log_date', $this->log_date)
            ->pluck('exercise_id')
            ->toArray();
    }

    public function updatedSelectedExerciseId()
    {
        $this->loadLogs();
    }

    public function loadLogs()
    {
        if (!$this->selectedExerciseId) return;

        // Load all logs for the table
        $this->logs = ExerciseLog::where('user_id', Auth::id())
            ->where('exercise_id', $this->selectedExerciseId)
            ->orderBy('log_date', 'desc')
            ->get();

        // Prepare monthly chart data
        $startOfMonth = \Carbon\Carbon::now()->startOfMonth();
        $endOfMonth = \Carbon\Carbon::now()->endOfMonth();
        
        $monthLogs = ExerciseLog::where('user_id', Auth::id())
            ->where('exercise_id', $this->selectedExerciseId)
            ->whereBetween('log_date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->get();

        $this->chartData = [];
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $dateString = $date->toDateString();
            
            // Find if there is a log for this specific date string
            $log = $monthLogs->first(function($item) use ($dateString) {
                // Handle both string and Carbon objects for log_date
                $itemDate = $item->log_date instanceof \Carbon\Carbon 
                    ? $item->log_date->toDateString() 
                    : substr($item->log_date, 0, 10);
                return $itemDate === $dateString;
            });
            
            $this->chartData[] = [
                'log_date' => $dateString,
                'weight' => $log ? (float)$log->weight : 0,
                'repetitions' => $log ? (int)$log->repetitions : 0,
                'has_data' => $log ? true : false
            ];
        }
    }

    public function store()
    {
        $this->validate();

        // Check if already logged today and not in edit mode
        if (!$this->isEditMode && in_array($this->selectedExerciseId, $this->loggedToday)) {
            session()->flash('error', 'Ya has registrado este ejercicio para hoy.');
            return;
        }

        if ($this->isEditMode) {
            $log = ExerciseLog::findOrFail($this->logId);
            abort_if($log->user_id !== Auth::id(), 403);
            $log->update([
                'exercise_id' => $this->selectedExerciseId,
                'weight' => $this->weight,
                'repetitions' => $this->repetitions,
                'time_spent_seconds' => $this->time_spent_seconds,
                'log_date' => $this->log_date,
            ]);
            session()->flash('message', 'Registro actualizado correctamente.');
        } else {
            ExerciseLog::create([
                'user_id' => Auth::id(),
                'exercise_id' => $this->selectedExerciseId,
                'weight' => $this->weight,
                'repetitions' => $this->repetitions,
                'time_spent_seconds' => $this->time_spent_seconds,
                'log_date' => $this->log_date,
            ]);

            // Check if routine is completed
            if ($this->selectedRoutineId) {
                $this->checkRoutineCompletion($this->selectedRoutineId);
            }

            session()->flash('message', 'Progreso guardado correctamente.');
        }

        $this->resetInput();
        $this->loadLoggedToday();
        $this->loadLogs();
        $this->dispatch('log-stored');
    }

    private function checkRoutineCompletion($routineId)
    {
        $routine = Routine::with('exercises')->find($routineId);
        $exerciseIds = $routine->exercises->pluck('id')->toArray();
        
        $loggedTodayCount = ExerciseLog::where('user_id', Auth::id())
            ->where('log_date', $this->log_date)
            ->whereIn('exercise_id', $exerciseIds)
            ->distinct('exercise_id')
            ->count();

        if ($loggedTodayCount >= count($exerciseIds)) {
            // All exercises logged. Mark routine as completed if not already marked today.
            $alreadyMarked = RoutineLog::where('user_id', Auth::id())
                ->where('routine_id', $routineId)
                ->whereDate('completed_at', $this->log_date)
                ->exists();

            if (!$alreadyMarked) {
                RoutineLog::create([
                    'user_id' => Auth::id(),
                    'routine_id' => $routineId,
                    'completed_at' => $this->log_date . ' ' . date('H:i:s'),
                ]);
                session()->flash('message', '¡Enhorabuena! Has completado todos los ejercicios de la rutina "' . $routine->name . '".');
            }
        }
    }

    public function edit($id)
    {
        $log = ExerciseLog::findOrFail($id);
        abort_if($log->user_id !== Auth::id(), 403);

        $this->logId = $id;
        $this->selectedExerciseId = $log->exercise_id;
        $this->weight = $log->weight;
        $this->repetitions = $log->repetitions;
        $this->time_spent_seconds = $log->time_spent_seconds;
        $this->log_date = $log->log_date;
        $this->isEditMode = true;
    }

    public function delete($id)
    {
        $log = ExerciseLog::findOrFail($id);
        abort_if($log->user_id !== Auth::id(), 403);
        $log->delete();
        $this->loadLogs();
        session()->flash('message', 'Registro eliminado.');
    }

    public function cancelEdit()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->reset(['weight', 'repetitions', 'time_spent_seconds', 'logId', 'isEditMode']);
        $this->log_date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.user-progress');
    }
}
