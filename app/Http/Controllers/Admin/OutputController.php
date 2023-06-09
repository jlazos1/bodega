<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\DetailsOutput;
use App\Models\Output;
use App\Models\ProductBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.outputs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id');

        return view('admin.outputs.create', compact('branches'));
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

        $output = new Output([
            'date'                  => $request->get('date'),
            'origin_branch_id'      => $request->get('origin_branch_id'),
            'destination_branch_id' => $request->get('destination_branch_id'),
        ]);
        $output->save();

        return redirect()->route('details_outputs', ['output_id' => $output->id]);
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
        $branches = Branch::pluck('name', 'id');
        $output = Output::find($id);
        $origin_branch_name = Branch::find($output->origin_branch_id)->name;

        return view('admin.outputs.edit', compact('branches', 'output', 'origin_branch_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Output $output)
    {
        $request->validate([
            'date'                  => 'required',
            'destination_branch_id' => 'required|different:origin_branch_id',
        ], [
            'date.required'                     => 'El campo Fecha es obligatorio',
            'destination_branch_id.required'    => 'El campo Sucursal Destino es obligatorio',
            'destination_branch_id.different'   => 'El campo Sucursal Destino debe ser diferente al campo Sucursal Origen',
        ]);

        if ($output->destination_branch_id != $request->get('destination_branch_id')) {

            $details = DetailsOutput::where('output_id', $output->id)->get();

            foreach ($details as $detail) {
                $product_branch = ProductBranch::where('product_id', $detail->product_id)
                    ->where('branch_id', $output->destination_branch_id)->first();

                $product_branch->update([
                    'quantity'  => $product_branch->quantity - $detail->quantity,
                ]);

                ProductBranch::updateOrInsert(
                    [
                        'product_id'    => $detail->product_id,
                        'branch_id'     => $request->get('destination_branch_id')
                    ],
                    [
                        'quantity'      =>  DB::raw("quantity + $detail->quantity")
                    ]
                );
            }

            $output->update([
                'date'                  => $request->get('date'),
                'destination_branch_id' => $request->get('destination_branch_id'),
            ]);

            return redirect()->route('details_outputs', ['output_id' => $output->id]);
        }

        return redirect()->route('details_outputs', ['output_id' => $output->id])->with('error', 'No se pudo realizar la acción');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
