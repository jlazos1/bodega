<?php

namespace App\Http\Livewire\Admin;

use App\Models\Machine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MachineBranchDashboard extends Component
{
    public function render()
    {
        $query = Machine::join('branches', 'machines.branch_id', '=', 'branches.id')
            ->select('branches.name', DB::raw('count(*) as total_maquinas'))
            ->where('machines.state', 0)
            ->groupBy('branches.name')
            ->get();

        $labels = $query->pluck('name')->toArray();
        $data = $query->pluck('total_maquinas')->toArray();

        return view('livewire.admin.machine-branch-dashboard', compact('labels', 'data'));
    }
}
