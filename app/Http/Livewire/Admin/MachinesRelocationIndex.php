<?php

namespace App\Http\Livewire\Admin;

use App\Models\MachineRelocation;
use App\Models\Relocation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MachinesRelocationIndex extends Component
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
        $relocations = MachineRelocation::
            join('branches AS ori', 'machine_relocations.origin', '=', 'ori.id')
            ->join('branches AS dest', 'machine_relocations.destination', '=', 'dest.id')
            ->select('machine_relocations.*', 'ori.name AS origin_name', 'dest.name AS destination_name')
            ->paginate();

        return view('livewire.admin.machines-relocation-index', compact('relocations'));
    }
}
