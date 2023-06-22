<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.branches.index')->only('index');
        $this->middleware('can:admin.branches.create')->only('create', 'store');
        $this->middleware('can:admin.branches.edit')->only('edit', 'update');
    }

    public function index()
    {
        return view('admin.branches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');

        return view('admin.branches.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'address'   => 'required',
            'phone'     => 'required',
            'city_id'   => 'required'
        ], [
            'name.required'         => 'El campo Nombre es obligatorio',
            'address.required'      => 'El campo Dirección es obligatorio',
            'phone.required'        => 'El campo Teléfono es obligatorio',
            'city_id.required'      => 'El campo Ciudad es obligatorio',
        ]);

        $branch = new Branch([
            'name'      => $request->get('name'),
            'address'   => $request->get('address'),
            'phone'     => $request->get('phone'),
            'city_id'   => $request->get('city_id'),
        ]);
        $branch->save();

        return redirect()->route('admin.branches.index')->with('info', 'Se creó la sucursal correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cities = City::pluck('name', 'id');
        $branch = Branch::find($id);

        return view('admin.branches.edit', compact('branch', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name'      => 'required',
            'address'   => 'required',
            'phone'     => 'required',
            'city_id'   => 'required'
        ], [
            'name.required'         => 'El campo Nombre es obligatorio',
            'address.required'      => 'El campo Dirección es obligatorio',
            'phone.required'        => 'El campo Teléfono es obligatorio',
            'city_id.required'      => 'El campo Ciudad es obligatorio',
        ]);
        
        $branch->update([
            'name'      => $request->get('name'),
            'address'   => $request->get('address'),
            'phone'     => $request->get('phone'),
            'city_id'   => $request->get('city_id'),
        ]);

        return redirect()->route('admin.branches.index')->with('info', 'Se modificaron los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
