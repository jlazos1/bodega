<?php

namespace App\Http\Livewire\Admin;

use App\Models\Machine;
use App\Models\MachineRelocation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailsMachinesRelocationIndex extends Component
{
    public function render()
    {
        $relocation = MachineRelocation::find($_REQUEST['id']);
        $machines = Machine::where('branch_id', $relocation->origin)
            ->select(DB::raw("CONCAT(id, ' - ', name) AS name_id, id"))
            ->pluck('name_id', 'id');

        $machinesAdd = DB::table('details_machine_relocations')
            ->join('machines', 'machines.id', '=', 'details_machine_relocations.machine_id')
            ->select('details_machine_relocations.*', 'machines.name AS machine_name', 'machines.id AS machine_id')
            ->where('machine_relocation_id', '=', $relocation->id)
            ->paginate();

        $relocation_id = $relocation->id;

        return view('livewire.admin.details-machines-relocation-index', compact('machines', 'machinesAdd', 'relocation_id'));
    }
}
