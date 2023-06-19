<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Relocation;
use App\Models\RelocationAssets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.relocations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id');

        return view('admin.relocations.create', compact('branches'));
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

        $relocation = new Relocation([
            'date'              => $request->get('date'),
            'origin'            => $request->get('origin_branch_id'),
            'destination'       => $request->get('destination_branch_id'),
        ]);
        $relocation->save();

        return redirect()->route('details_relocations', ['id' => $relocation->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $relocation = Relocation::find($id);
        $origin_name = Branch::find($relocation->origin)->name;
        $destination_name = Branch::find($relocation->destination)->name;

        $assetsAdd = DB::table('relocation_assets')
            ->join('assets', 'assets.id', '=', 'relocation_assets.asset_id')
            ->select('relocation_assets.*', 'assets.name AS asset_name', 'assets.id AS asset_id')
            ->where('relocation_id', '=', $relocation->id)
            ->paginate();

        return view('admin.relocations.show', compact('relocation', 'assetsAdd', 'origin_name', 'destination_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branches = Branch::pluck('name', 'id');

        return view('admin.relocations.edit', compact('branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
