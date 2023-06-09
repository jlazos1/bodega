<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|unique:product_types',
        ], [
            'name.required'     => 'El campo Nombre es obligatorio',
            'name.unique'       => 'La categoría ingresada ya se encuentra registrada'
        ]);

        $product_type = new ProductType([
            'name'  => $request->get('name'),
        ]);
        $product_type->save();

        return redirect()->route('admin.product_types.index')->with('info', 'Se creó la Categoría de Producto correctamente');
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
        $product_type = ProductType::find($id);

        return view('admin.product_types.edit', compact('product_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductType $product_type)
    {
        $product_type->update([
            'name' => $request->get('name')
        ]);

        return redirect()->route('admin.product_types.index')->with('info', 'Se modificaron los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_type = ProductType::find($id);
        $product_type->delete();

        return redirect()->route('admin.product_types.index')->with('info', 'Se eliminó la categoría de producto');
    }
}
