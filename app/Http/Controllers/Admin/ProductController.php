<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.products.index')->only('index');
        $this->middleware('can:admin.products.create')->only('create', 'store');
        $this->middleware('can:admin.products.edit')->only('edit', 'update');

    }

    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_types = ProductType::pluck('name', 'id');

        return view('admin.products.create', compact('product_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'product_type_id'   => 'required',
        ], [
            'name.required'             => 'El campo Nombre es obligatorio',
            'product_type_id.required'  => 'El campo Tipo de Producto es obligatorio',
        ]);

        $product = new Product([
            'name'              => $request->get('name'),
            'product_type_id'   => $request->get('product_type_id'),
        ]);
        $product->save();

        return redirect()->route('admin.products.index')->with('info', 'Se creó el Producto correctamente');
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
        $product = Product::find($id);
        $product_types = ProductType::pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'product_types'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'              => 'required',
            'product_type_id'   => 'required',
        ], [
            'name.required'             => 'El campo Nombre es obligatorio',
            'product_type_id.required'  => 'El campo Tipo de Producto es obligatorio',
        ]);
        
        $product->update([
            'name'              => $request->get('name'),
            'product_type_id'   => $request->get('product_type_id'),
        ]);

        return redirect()->route('admin.products.index')->with('info', 'Se modificaron los datos correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
