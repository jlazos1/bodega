<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $product = new Product([
            'name'              => $request->get('name'),
            'price'             => $request->get('price'),
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
        $product->update([
            'name'              => $request->get('name'),
            'price'             => $request->get('price'),
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
