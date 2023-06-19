<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Relocation;
use App\Models\RelocationAssets;
use Illuminate\Http\Request;

class DetailsRelocationController extends Controller
{
    public $select = [];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $relo = Relocation::find($request->get('relocation_id'));

        foreach ($request->get('seleccion') as $sel) {

            $rel_as = new RelocationAssets([
                'relocation_id' => $request->get('relocation_id'),
                'asset_id'      => $sel
            ]);
            $rel_as->save();

            $asset = Asset::find($sel);
            $asset->update([
                'branch_id' => $relo->destination,
            ]);
        }

        return redirect()->route('details_relocations', ['id' => $request->get('relocation_id')])->with('correct', 'Activo eliminado correctamente');

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
