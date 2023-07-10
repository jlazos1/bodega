<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\DetailsInput;
use App\Models\Input;
use App\Models\ProductBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailsInputController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.detalles-inputs.create')->only('create', 'store');
        $this->middleware('can:admin.detalles-inputs.destroy')->only('destroy');

    }

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
        $request->validate([
            'product_id'        => 'required',
            'quantity'          => 'required',
            'price'             => 'required',
        ], [
            'product_id.required'       => 'El campo Producto es obligatorio',
            'quantity.required'         => 'El campo Cantidad es obligatorio',
            'price.required'            => 'El campo Precio Unitario es obligatorio',
        ]);

        $details = DetailsInput::where('product_id', $request->get('product_id'))
            ->where('input_id', $request->get('input_id'))
            ->first();

        $input = Input::where('id', $request->get('input_id'))->first();

        if ($details == null) {
            $details = new DetailsInput([
                'product_id'    => $request->get('product_id'),
                'input_id'      => $request->get('input_id'),
                'quantity'      => $request->get('quantity'),
                'price'         => $request->get('price'),
            ]);
            $details->save();

            $input->update([
                'net_amount'    => $input->net_amount + ($request->get('quantity') * $request->get('price')),
            ]);

        } else {
            return redirect()->route('details_inputs', ['input_id' => $request->get('input_id')])->with('error', 'El producto ya se encuentra agregado');
        }        

        $branch_id = DB::table('inputs')->where('id', $request->get('input_id'))->first()->branch_id;
        //$branch_id = Branch::find($request->get('input_id'))->id;
        $product_branch = ProductBranch::where('product_id', $request->get('product_id'))
            ->where('branch_id', $branch_id)
            ->first();


        if ($product_branch == null) {
            $product_branch = new ProductBranch([
                'product_id'    => $request->get('product_id'),
                'branch_id'     => $branch_id,
                'quantity'      => $request->get('quantity'),
            ]);
            $product_branch->save();
        } else {
            $product_branch->update([
                'quantity'      => $product_branch->quantity + $request->get('quantity'),
            ]);
        }
        return redirect()->route('details_inputs', ['input_id' => $request->get('input_id')]);
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
        $details = DetailsInput::where('id', $id)->first();
        $branch_id = Input::where('id', $details->input_id)->first()->branch_id;


        $product_branch = ProductBranch::where('product_id', $details->product_id)
            ->where('branch_id', $branch_id)
            ->first();

        $product_branch->update([
            'quantity'      => $product_branch->quantity - $details->quantity,
        ]);

        $input_id = $details->input_id;

        $input = Input::where('id', $input_id)->first();
        $input->update([
            'net_amount'    => $input->net_amount - ($details->quantity * $details->price),
        ]);

        $details->delete();

        return redirect()->route('details_inputs', ['input_id' => $input_id]);
    }
}
