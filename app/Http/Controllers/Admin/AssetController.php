<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetType;
use App\Models\Branch;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.assets.index')->only('index');
        $this->middleware('can:admin.assets.create')->only('create', 'store');
        $this->middleware('can:admin.assets.edit')->only('edit', 'update');
        $this->middleware('can:admin.assets.show')->only('show');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.assets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asset_types = AssetType::pluck('name', 'id');
        $branches = Branch::pluck('name', 'id');

        return view('admin.assets.create', compact('asset_types', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'value'             => 'required',
            'branch_id'         => 'required',
            'asset_type_id'     => 'required'
        ], [
            'name.required'             => 'El campo Nombre es obligatorio',
            'value.required'            => 'El campo Valor es obligatorio',
            'branch_id.required'        => 'El campo Sucursal es obligatorio',
            'asset_type_id.required'    => 'El campo Tipo de Activo es obligatorio',
        ]);

        $asset = new Asset([
            'name'              => $request->get('name'),
            'value'             => $request->get('value'),
            'branch_id'         => $request->get('branch_id'),
            'asset_type_id'     => $request->get('asset_type_id')
        ]);
        $asset->save();
        return redirect()->route('admin.assets.index')->with('info', 'Se creó el Activo correctamente');
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
        $asset = Asset::find($id);

        $asset_types = AssetType::pluck('name', 'id');
        $branches = Branch::pluck('name', 'id');

        return view('admin.assets.edit', compact('asset', 'asset_types', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'name'              => 'required',
            'value'             => 'required',
            'branch_id'         => 'required',
            'asset_type_id'     => 'required'
        ], [
            'name.required'             => 'El campo Nombre es obligatorio',
            'value.required'            => 'El campo Valor es obligatorio',
            'branch_id.required'        => 'El campo Sucursal es obligatorio',
            'asset_type_id.required'    => 'El campo Tipo de Activo es obligatorio',
        ]);
        
        $asset->update([
            'name'              => $request->get('name'),
            'value'             => $request->get('value'),
            'branch_id'         => $request->get('branch_id'),
            'asset_type_id'    => $request->get('asset_type_id')
        ]);

        return redirect()->route('admin.assets.index')->with('info', 'Se modificaron los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function qrcode(string $url)
    {
        return view('qrcode', compact('url'));
    }
}
