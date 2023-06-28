<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenancesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.maintenances.index')->only('index');
        $this->middleware('can:admin.maintenances.create')->only('create', 'store');
        $this->middleware('can:admin.maintenances.show')->only('show');
    }
    
    public function index()
    {
        return view('admin.maintenances.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $machines = Machine::select(DB::raw("CONCAT(id, ' - ', name) AS name_id, id"))
            ->pluck('name_id', 'id');

        return view('admin.maintenances.create', compact('machines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'machine_id'        => 'required',
            'date'              => 'required',
            'details'           => 'required',
        ],[
            'machine_id.required'        => 'El campo Nombre Máquina es obligatorio',
            'date.required'              => 'El campo Fecha es obligatorio',
            'details.required'           => 'El campo Detalles es obligatorio',
        ]);

        $maintenance = new Maintenance([
            'machine_id'    => $request->get('machine_id'),
            'date'          => $request->get('date'),
            'details'       => $request->get('details'),
            'user_id'       => auth()->id(),
        ]);
        $maintenance->save();

        return redirect()->route('admin.maintenances.index')->with('info', 'Se registró el Mantenimiento correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maintenance = Maintenance::find($id);
        $machine_name = Machine::find($maintenance->machine_id)->name;
        $user_name = User::find($maintenance->user_id)->name;

        return view('admin.maintenances.show', compact('maintenance','machine_name', 'user_name'));
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
