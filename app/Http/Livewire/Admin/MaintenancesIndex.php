<?php

namespace App\Http\Livewire\Admin;

use App\Models\Maintenance;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MaintenancesIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $maintenances = DB::table('maintenances')
            ->join('machines', 'machines.id', '=', 'maintenances.machine_id')
            ->join('users', 'users.id', '=', 'maintenances.user_id')
            ->join('branches', 'branches.id', '=', 'machines.branch_id')
            ->select('maintenances.*', 'machines.name AS machine_name', 'users.name AS user_name', 'branches.name AS branch_name')
            ->where('machines.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('users.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('branches.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.maintenances-index', compact('maintenances'));
    }
}
