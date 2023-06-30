<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\GamesBoard;
use App\Models\Machine;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.machines.index')->only('index');
        $this->middleware('can:admin.machines.create')->only('create', 'store');
        $this->middleware('can:admin.machines.edit')->only('edit', 'update');

    }

    public function index()
    {
        return view('admin.machines.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id');
        $games_boards = GamesBoard::pluck('name', 'id');

        return view('admin.machines.create', compact('games_boards', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'value'             => 'required',
            'games_board_id'    => 'required',
            'branch_id'         => 'required',
        ], [
            'name.required'              => 'El campo Nombre es necesario',
            'value.required'             => 'El campo Valor es necesario',
            'games_board_id.required'    => 'El campo Tarjera de Juego es necesario',
            'branch_id.required'         => 'El campo Sucursal es necesario',
        ]);

        $machine = new Machine([
            'name'              => $request->get('name'),
            'value'             => $request->get('value'),
            'games_board_id'    => $request->get('games_board_id'),
            'branch_id'         => $request->get('branch_id')
        ]);
        $machine->save();


        return redirect()->route('admin.machines.index')->with('info', 'Se creó la máquina correctamente');
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
        $machine = Machine::find($id);
        $branches = Branch::pluck('name', 'id');
        $games_boards = GamesBoard::pluck('name', 'id');

        return view('admin.machines.edit', compact('machine', 'branches', 'games_boards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'              => 'required',
            'value'             => 'required',
            'games_board_id'    => 'required',
            'branch_id'         => 'required',
        ], [
            'name.required'              => 'El campo Nombre es necesario',
            'value.required'             => 'El campo Valor es necesario',
            'games_board_id.required'    => 'El campo Tarjera de Juego es necesario',
            'branch_id.required'         => 'El campo Sucursal es necesario',
        ]);

        $machine = Machine::find($id);
        $machine->update([
            'name'              => $request->get('name'),
            'value'             => $request->get('value'),
            'games_board_id'    => $request->get('games_board_id'),
            'branch_id'         => $request->get('branch_id')
        ]);

        return redirect()->route('admin.machines.index')->with('info', 'Se actualizó la máquina correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function qrcode(string $url)
    {
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($url));
        $pdf = PDF::loadView('qrcode', compact('url', 'qrcode'));
        return $pdf->stream();
    }
}
