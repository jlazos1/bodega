<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.providers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');

        return view('admin.providers.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $provider = new Provider([
            'name'      => $request->get('name'),
            'address'   => $request->get('address'), 
            'phone'     => $request->get('phone'),
            'email'     => $request->get('email'),
            'city_id'   => $request->get('city_id'),
        ]);
        $provider->save();

        return redirect()->route('admin.providers.index')->with('info', 'Se creó la sucursal correctamente');
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
        $provider = Provider::find($id);

        return view('admin.providers.edit', compact('provider', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $provider = Provider::find($id);

        $provider->update([
            'name'      => $request->get('name'),
            'address'   => $request->get('address'), 
            'phone'     => $request->get('phone'),
            'email'     => $request->get('email'),
            'city_id'   => $request->get('city_id'),
        ]);

        return redirect()->route('admin.providers.index', $provider)->with('info', 'Se modificaron los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
