<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\DetailsInputsIndex;
use App\Models\Branch;
use App\Models\DetailsInput;
use App\Models\DocumentType;
use App\Models\Input;
use App\Models\ProductBranch;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.inputs.index')->only('index');
        $this->middleware('can:admin.inputs.create')->only('create', 'store');
        $this->middleware('can:admin.inputs.edit')->only('edit', 'update');
        $this->middleware('can:admin.inputs.show')->only('show');

    }

    public function index()
    {
        return view('admin.inputs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $providers = Provider::pluck('name', 'id');
        $doc_types = DocumentType::pluck('name', 'id');
        $branches = Branch::pluck('name', 'id');

        return view('admin.inputs.create', compact('providers', 'doc_types', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'              => 'required',
            'branch_id'         => 'required',
        ], [
            'date.required'             => 'El campo Fecha es obligatorio',
            'branch_id.required'        => 'El campo Sucursal es obligatorio',
        ]);

        $input = new Input([
            'date'              => $request->get('date'),
            'provider_id'       => $request->get('provider_id'),
            'document_type_id'  => $request->get('document_type_id'),
            'branch_id'         => $request->get('branch_id'),
            'doc_number'        => $request->get('doc_number'),
            'net_amount'        => 0,
            'iva'               => 0,
        ]);
        $input->save();
        $input_id = $input->id;

        return redirect()->route('details_inputs', ['input_id' => $input_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $input = Input::find($id);
        $branch_name = Branch::find($input->branch_id)->name;
        $provider_name = 'Sin Información';
        $type_doc = 'Sin Información';

        if($input->provider_id != null){
            $provider_name = Provider::find($input->provider_id)->name;
        }

        if($input->document_type_id != null){
            $type_doc = DocumentType::find($input->document_type_id)->name;
        }

        $productsAdd = DetailsInput::where('input_id', '=', $input->id)
            ->join('products', 'products.id', '=', 'details_inputs.product_id')
            ->select('details_inputs.*', 'products.name AS product_name')
            ->get();

        return view('admin.inputs.show', compact('input', 'provider_name', 'type_doc', 'branch_name', 'productsAdd'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $providers = Provider::pluck('name', 'id');
        $doc_types = DocumentType::pluck('name', 'id');
        $branches = Branch::pluck('name', 'id');
        $input = Input::find($id);

        return view('admin.inputs.edit', compact('providers', 'doc_types', 'branches', 'input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Input $input)
    {
        $request->validate([
            'date'              => 'required',
            'branch_id'         => 'required',
        ], [
            'date.required'             => 'El campo Fecha es obligatorio',
            'branch_id.required'        => 'El campo Sucursal es obligatorio',
        ]);

        $branch_last = $input->branch_id;
        $input->update([
            'date'              => $request->get('date'),
            'provider_id'       => $request->get('provider_id'),
            'document_type_id'  => $request->get('document_type_id'),
            'branch_id'         => $request->get('branch_id'),
            'doc_number'        => $request->get('doc_number'),
        ]);
        $input->save();
        $input_id = $input->id;

        $details_input = DetailsInput::where('input_id', $input->id)->get();

        if ($branch_last != $input->branch_id) {
            foreach ($details_input as $dinputs) {
                $product_branch = ProductBranch::where('product_id', $dinputs->product_id)
                    ->where('branch_id', $branch_last)
                    ->first();

                $product_branch->update([
                    'quantity'      => $product_branch->quantity - $dinputs->quantity,
                ]);

                ProductBranch::updateOrInsert(
                    ['product_id' => $dinputs->product_id, 'branch_id' => $input->branch_id],
                    ['quantity' => DB::raw("quantity + $dinputs->quantity")]
                );
            }
        }

        return redirect()->route('details_inputs', ['input_id' => $input_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
