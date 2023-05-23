<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\Branch;
use Illuminate\Http\Request;

class AssetController extends Controller
{
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
        $asset_models = AssetModel::pluck('name', 'id');
        $branches = Branch::pluck('name', 'id');

        return view('admin.assets.create', compact('asset_models', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asset = new Asset([
            'name'              => $request->get('name'),
            'value'             => $request->get('value'),
            'branch_id'         => $request->get('branch_id'),
            'asset_model_id'    => $request->get('asset_model_id')
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

        $asset_models = AssetModel::pluck('name', 'id');
        $branches = Branch::pluck('name', 'id');

        return view('admin.assets.edit', compact('asset', 'asset_models', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $asset->update([
            'name'              => $request->get('name'),
            'value'             => $request->get('value'),
            'branch_id'         => $request->get('branch_id'),
            'asset_model_id'    => $request->get('asset_model_id')
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
}
