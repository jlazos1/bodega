<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetModel;
use App\Models\AssetType;
use Illuminate\Http\Request;

class AssetModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.asset_models.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asset_types = AssetType::pluck('name', 'id');

        return view('admin.asset_models.create', compact('asset_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asset_model = new AssetModel([
            'name'          => $request->get('name'),
            'description'   => $request->get('description'),
            'asset_type_id' => $request->get('asset_type_id')
        ]);
        $asset_model->save();

        return redirect()->route('admin.asset_models.index')->with('info', 'Se creó el Modelo de Activo correctamente');
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
        $asset_model = AssetModel::find($id);
        $asset_types = AssetType::pluck('name', 'id');

        return view('admin.asset_models.edit', compact('asset_model', 'asset_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetModel $asset_model)
    {
        $asset_model->update([
            'name'          => $request->get('name'),
            'description'   => $request->get('description'),
            'asset_type_id' => $request->get('asset_type_id')
        ]);

        return redirect()->route('admin.asset_models.index')->with('info', 'Se modificaron los datos correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asset_model = AssetModel::find($id);
        $asset_model->delete();

        return redirect()->route('admin.asset_models.index')->with('info', 'Se eliminó el modelo de activo');
    }
}
