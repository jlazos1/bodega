<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $branches = DB::table('branches')
            ->join('cities', 'cities.id', '=', 'branches.city_id')
            ->pluck('branches.name', 'branches.id');

        return view('admin.users.create', compact('roles', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'branch_id' => $request->get('branch_id')
        ]);
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index', $user)->with('info', 'Se creó el usuario correctamente');
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
        $user = User::find($id);

        $roles = Role::all();
        $branches = DB::table('branches')
            ->join('cities', 'cities.id', '=', 'branches.city_id')
            ->pluck('branches.name', 'branches.id');

        return view('admin.users.edit', compact('user', 'roles', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email') ,
            'branch_id' => $request->get('branch_id')  
        ]);

        return redirect()->route('admin.users.index', $user)->with('info', 'Se modificaron los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
