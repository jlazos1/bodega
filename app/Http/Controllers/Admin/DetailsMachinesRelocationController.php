<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailsMachineRelocation;
use App\Models\Machine;
use App\Models\MachineRelocation;
use Illuminate\Http\Request;

class DetailsMachinesRelocationController extends Controller
{
    public $select = [];

    public function __construct()
    {
        $this->middleware('can:admin.machines-details-relocations.create')->only('create', 'store');
        $this->middleware('can:admin.machines-details-relocations.destroy')->only('destroy');

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'seleccion' => 'required',
        ],[
            'seleccion.required'    => 'Seleccione por lo menos una máquina',
        ]);

        $relo = MachineRelocation::find($request->get('relocation_id'));

        foreach ($request->get('seleccion') as $sel) {

            $rel_as = new DetailsMachineRelocation([
                'machine_relocation_id' => $relo->id,
                'machine_id'            => $sel
            ]);
            $rel_as->save();

            $machine = Machine::find($sel);
            $machine->update([
                'branch_id' => $relo->destination,
            ]);
        }

        return redirect()->route('details-machine-relocations', ['id' => $request->get('relocation_id')])->with('correct', 'Máquina agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = DetailsMachineRelocation::find($id);
        $machine = Machine::find($detail->machine_id);
        $relocation = MachineRelocation::find($detail->machine_relocation_id);

        $machine->update([
            'branch_id'     => $relocation->origin,
        ]);
        $detail->delete();

        return redirect()->route('details-machine-relocations', ['id' => $relocation->id])->with('correct', 'Máquina eliminada correctamente');

    }
}
