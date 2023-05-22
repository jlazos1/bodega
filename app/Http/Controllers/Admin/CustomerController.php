<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');

        return view('admin.customers.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = new Customer([
            'name'      => $request->get('name'),
            'address'   => $request->get('address'), 
            'phone'     => $request->get('phone'),
            'email'     => $request->get('email'),
            'city_id'   => $request->get('city_id'),
        ]);
        $customer->save();

        return redirect()->route('admin.customers.index')->with('info', 'Se creó la sucursal correctamente');
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
        $cities = City::pluck('name', 'id');
        $customer = customer::find($id);

        return view('admin.customers.edit', compact('customer', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = customer::find($id);

        $customer->update([
            'name'      => $request->get('name'),
            'address'   => $request->get('address'), 
            'phone'     => $request->get('phone'),
            'email'     => $request->get('email'),
            'city_id'   => $request->get('city_id'),
        ]);

        return redirect()->route('admin.customers.index', $customer)->with('info', 'Se modificaron los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
