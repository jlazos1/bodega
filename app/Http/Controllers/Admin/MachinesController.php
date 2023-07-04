<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\DetailsMachineRelocation;
use App\Models\GamesBoard;
use App\Models\Loan;
use App\Models\Machine;
use App\Models\MachineRelocation;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.machines.index')->only('index');
        $this->middleware('can:admin.machines.create')->only('create', 'store');
        $this->middleware('can:admin.machines.edit')->only('edit', 'update');
        $this->middleware('can:admin.machines.show')->only('show');
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
        $machine = Machine::find($id);
        $game_board = GamesBoard::find($machine->games_board_id)->name;
        $branch_name = Branch::find($machine->branch_id)->name;

        $loans = DB::table('machine_loans')
            ->join('loans', 'loans.id', '=', 'machine_loans.loan_id')
            ->join('customers', 'customers.id', '=', 'loans.customer_id')
            ->join('loan_states', 'loan_states.id', '=', 'loans.loan_state_id')
            ->select('loans.*', 'customers.name AS customer_name', 'loan_states.name AS loan_state_name')
            ->where('machine_loans.machine_id', $machine->id)
            ->get();

        $relocations = DB::table('details_machine_relocations')
            ->join('machine_relocations', 'machine_relocations.id', '=', 'details_machine_relocations.machine_relocation_id')
            ->join('branches AS ori', 'machine_relocations.origin', '=', 'ori.id')
            ->join('branches AS dest', 'machine_relocations.destination', '=', 'dest.id')
            ->select('machine_relocations.*', 'ori.name AS origin_name', 'dest.name AS destination_name')
            ->where('details_machine_relocations.machine_id', '=', $machine->id)
            ->get();   

        $maintenances = DB::table('maintenances')
            ->join('users', 'users.id', '=', 'maintenances.user_id')
            ->select('maintenances.*', 'users.name AS user_name')
            ->where('maintenances.machine_id', $machine->id)
            ->get();

        return view('admin.machines.show', compact('machine', 'game_board', 'branch_name', 'loans', 'relocations', 'maintenances'));
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
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('http://777gnv.com:8000/admin/machines/'.$url));
        $pdf = PDF::loadView('qrcode', compact('url', 'qrcode'));
        return $pdf->stream();
    }
}
