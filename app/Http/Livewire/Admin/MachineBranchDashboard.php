<?php

namespace App\Http\Livewire\Admin;

use App\Models\Branch;
use App\Models\Machine;
use Livewire\Component;

class MachineBranchDashboard extends Component
{
    public $branch;
    public $count = "";

    public $branches;

    public function mount(){
        $this->branches = Branch::all();
    }
    public function updatedBranch($value){
        $this->count = Machine::where('branch_id', $value)->count();
    }

    public function render()
    {
        $count = $this->count;
        return view('livewire.admin.machine-branch-dashboard', compact('count'));
    }
}
