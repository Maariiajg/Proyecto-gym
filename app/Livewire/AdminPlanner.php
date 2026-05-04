<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WeeklyPlan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;

class AdminPlanner extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';
    
    public $selectedUserId = null;
    public $activeTab = 'all'; // 'all' or 'mine'

    public function mount()
    {
        // If not admin, just show their own plan
        if (!Auth::user()->hasRole('admin')) {
            $this->activeTab = 'mine';
        }
    }

    public function render()
    {
        if ($this->activeTab === 'mine') {
            return view('livewire.admin-planner', [
                'isOwnPlan' => true
            ]);
        }

        // Get users with their weekly plans
        $users = User::where('id', '!=', Auth::id())
            ->where('name', 'like', '%' . $this->search . '%')
            ->with(['weeklyPlans.routine'])
            ->paginate(10);

        return view('livewire.admin-planner', [
            'users' => $users,
            'isOwnPlan' => false
        ]);
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
    }

    public function closeUserPlan()
    {
        $this->selectedUserId = null;
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->selectedUserId = null;
        $this->resetPage();
    }
}
