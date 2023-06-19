<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\MachineRelocation;
use App\Models\Relocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachinesRelocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.relocations-machines.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id');

        return view('admin.relocations-machines.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'                  => 'required',
            'origin_branch_id'      => 'required',
            'destination_branch_id' => 'required|different:origin_branch_id',
        ], [
            'date.required'                     => 'El campo Fecha es obligatorio',
            'origin_branch_id.required'         => 'El campo Sucursal Origen es obligatorio',
            'destination_branch_id.required'    => 'El campo Sucursal Destino es obligatorio',
            'destination_branch_id.different'   => 'El campo Sucursal Destino debe ser diferente al campo Sucursal Origen',
        ]);

        $relocation = new MachineRelocation([
            'date'              => $request->get('date'),
            'origin'            => $request->get('origin_branch_id'),
            'destination'       => $request->get('destination_branch_id'),
        ]);
        $relocation->save();

        return redirect()->route('details-machine-relocations', ['id' => $relocation->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $relocation = MachineRelocation::find($id);
        $origin_name = Branch::find($relocation->origin)->name;
        $destination_name = Branch::find($relocation->destination)->name;

        $machinesAdd = DB::table('details_machine_relocations')
            ->join('machines', 'machines.id', '=', 'details_machine_relocations.machine_id')
            ->select('details_machine_relocations.*', 'machines.name AS machine_name', 'machines.id AS machine_id')
            ->where('machine_relocation_id', '=', $relocation->id)
            ->paginate();

        return view('admin.relocations-machines.show', compact('relocation', 'machinesAdd', 'origin_name', 'destination_name'));
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
        //
    }
}
