<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetModel;
use App\Models\AssetType;
use Illuminate\Http\Request;

class AssetModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.asset_models.index')->only('index');
        $this->middleware('can:admin.asset_models.create')->only('create', 'store');
        $this->middleware('can:admin.asset_models.edit')->only('edit', 'update');
        $this->middleware('can:admin.asset_models.destroy')->only('destroy');
    }

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
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'asset_type_id' => 'required'
        ], [
            'name.required'             => 'El campo Nombre es obligatorio',
            'description.required'      => 'El campo Descripción es obligatorio',
            'asset_type_id.required'    => 'El campo Tipo de Activo es obligatorio',
        ]);

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
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'asset_type_id' => 'required'
        ], [
            'name.required'             => 'El campo Nombre es obligatorio',
            'description.required'      => 'El campo Descripción es obligatorio',
            'asset_type_id.required'    => 'El campo Tipo de Activo es obligatorio',
        ]);

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
