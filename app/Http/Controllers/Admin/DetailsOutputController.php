<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailsOutput;
use App\Models\Output;
use App\Models\ProductBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailsOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $output = Output::find($request->get('output_id'));

        $origin = ProductBranch::where('product_id', $request->get('product_id'))
            ->where('branch_id', $output->origin_branch_id)
            ->first();

        if ($this->checkStock($origin->branch_id, $request->product_id, $request->quantity)) {

            DetailsOutput::updateOrInsert(
                [
                    'output_id'     => $request->get('output_id'),
                    'product_id'    => $request->get('product_id')
                ],
                [
                    'quantity'      => $request->get('quantity'),
                ]
            );

            $origin->update([
                'quantity'      => $origin->quantity - $request->get('quantity')
            ]);

            $quantity = intval($request->get('quantity'));
            ProductBranch::updateOrInsert(
                [
                    'product_id'    => $request->get('product_id'),
                    'branch_id'     => $output->destination_branch_id
                ],
                [
                    'quantity'      =>  DB::raw("quantity + $quantity")
                ]
            );
        }

        return redirect()->route('details_outputs', ['output_id' => $request->get('output_id')]);

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
        $details = DetailsOutput::find($id);
        $output = Output::find($details->output_id);

        $origin = ProductBranch::where('product_id', $details->product_id)
            ->where('branch_id', $output->origin_branch_id)
            ->first();

        $origin->update([
            'quantity'      =>  $origin->quantity + $details->quantity
        ]);    

        $destination = ProductBranch::where('product_id', $details->product_id)
            ->where('branch_id', $output->destination_branch_id)
            ->first();

        $destination->update([
            'quantity'      =>  $destination->quantity - $details->quantity
        ]);   
        
        $details->delete();
        return redirect()->route('details_outputs', ['output_id' => $output->id]);

    }

    public function checkStock($branch_id, $product_id, $quantity)
    {

        $stock = ProductBranch::where('branch_id', $branch_id)
            ->where('product_id', $product_id)
            ->first();

        if ($stock->quantity >= $quantity) {
            return true;
        }

        return false;
    }
}
