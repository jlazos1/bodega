<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use Illuminate\Http\Request;

class AssetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.asset_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.asset_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asset_type = new AssetType([
            'name'  => $request->get('name'),
        ]);
        $asset_type->save();

        return redirect()->route('admin.asset_types.index')->with('info', 'Se creó el Tipo de Activo correctamente');
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
        $asset_type = AssetType::find($id);

        return view('admin.asset_types.edit', compact('asset_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetType $asset_type)
    {
        $asset_type->update([
            'name' => $request->get('name')
        ]);

        return redirect()->route('admin.asset_types.index')->with('info', 'Se modificaron los datos correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asset_type = AssetType::find($id);
        $asset_type->delete();

        return redirect()->route('admin.asset_types.index')->with('info', 'Se eliminó el tipo de activo');

    }
}
