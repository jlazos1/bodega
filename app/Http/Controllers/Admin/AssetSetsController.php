<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetSetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.asset_sets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slots = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 1)
            ->pluck('assets.name', 'assets.id');

        $screens = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 2)
            ->pluck('assets.name', 'assets.id');

        $pcs = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 3)
            ->pluck('assets.name', 'assets.id');

        $boards = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 4)
            ->pluck('assets.name', 'assets.id');

        return view('admin.asset_sets.create', compact('slots', 'screens', 'pcs', 'boards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slot_id'       => 'required|unique:sets',
            'screen_id'     => 'nullable|unique:sets',
            'pc_id'         => 'nullable|unique:sets',
            'card_id'       => 'nullable|unique:sets'
        ], [
            'slot_id.required'      => 'El campo Máquina es obligatorio',
            'slot_id.unique'        => 'Esta Máquina ya se encuentra registrada en un conjunto',
            'screen_id.unique'      => 'Esta Pantalla ya se encuentra registrada en un conjunto',
            'pc_id.unique'          => 'Este Computador ya se encuentra registrada en un conjunto',
            'card_id.unique'        => 'Esta IO Board ya se encuentra registrada en un conjunto',

        ]);

        $set = new Set([
            'slot_id'       => $request->get('slot_id'),
            'screen_id'     => $request->get('screen_id'),
            'pc_id'         => $request->get('pc_id'),
            'card_id'       => $request->get('card_id')
        ]);
        $set->save();

        return redirect()->route('admin.asset_sets.index')->with('info', 'Se creó el Conjunto correctamente');
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
        $slots = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 1)
            ->pluck('assets.name', 'assets.id');

        $screens = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 2)
            ->pluck('assets.name', 'assets.id');

        $pcs = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 3)
            ->pluck('assets.name', 'assets.id');

        $boards = DB::table('assets')
            ->select('assets.*', 'asset_models.name AS asset_model_name', 'asset_models.asset_type_id AS asset_type_id')
            ->join('asset_models', 'assets.asset_model_id', '=', 'asset_models.id')
            ->where('asset_models.asset_type_id', '=', 4)
            ->pluck('assets.name', 'assets.id');

        $set = Set::find($id);

        return view('admin.asset_sets.edit', compact('slots', 'screens', 'pcs', 'boards', 'set'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Set $set)
    {
        $request->validate([
            'slot_id'       => 'required|unique:sets',
            'screen_id'     => 'nullable|unique:sets',
            'pc_id'         => 'nullable|unique:sets',
            'card_id'       => 'nullable|unique:sets'
        ], [
            'slot_id.required'      => 'El campo Máquina es obligatorio',
            'slot_id.unique'        => 'Esta Máquina ya se encuentra registrada en un conjunto',
            'screen_id.unique'      => 'Esta Pantalla ya se encuentra registrada en un conjunto',
            'pc_id.unique'          => 'Este Computador ya se encuentra registrada en un conjunto',
            'card_id.unique'        => 'Esta IO Board ya se encuentra registrada en un conjunto',

        ]);

        dd($set);

        $set->update([
            'slot_id'       => $request->get('slot_id'),
            'screen_id'     => $request->get('screen_id'),
            'pc_id'         => $request->get('pc_id'),
            'card_id'       => $request->get('card_id')
        ]);

        return redirect()->route('admin.asset_sets.index')->with('info', 'Se modificó el Conjunto correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
