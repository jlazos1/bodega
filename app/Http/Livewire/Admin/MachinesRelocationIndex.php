<?php

namespace App\Http\Livewire\Admin;

use App\Models\MachineRelocation;
use App\Models\Relocation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MachinesRelocationIndex extends Component
{
    use WithPagination;

    public $search;
    
    public $from_date = "";
    public $to_date = "";

    protected $paginationTheme = "bootstrap";

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $relocations = MachineRelocation::
            join('branches AS ori', 'machine_relocations.origin', '=', 'ori.id')
            ->join('branches AS dest', 'machine_relocations.destination', '=', 'dest.id')
            ->select('machine_relocations.*', 'ori.name AS origin_name', 'dest.name AS destination_name')
            ->where(function ($query) {
                $query->where('ori.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('dest.name', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->from_date && $this->to_date, function ($query) {
                $query->whereBetween('machine_relocations.date', [
                    Carbon::parse($this->from_date)->startOfDay(),
                    Carbon::parse($this->to_date)->endOfDay()
                ]);
            })
            ->orderBy('machine_relocations.id')
            ->paginate();

        return view('livewire.admin.machines-relocation-index', compact('relocations'));
    }
}
