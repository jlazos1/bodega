<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Machine;
use App\Models\MachineLoan;
use Illuminate\Http\Request;

class DetailsLoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            'seleccion' => 'required',
        ],[
            'seleccion.required'    => 'Seleccione por lo menos una máquina',
        ]);

        $loan = Loan::find($request->get('loan_id'));

        foreach ($request->get('seleccion') as $sel) {

            $detail = new MachineLoan([
                'machine_id'    => $sel,
                'loan_id'       => $loan->id
            ]);
            $detail->save();

            //state 1 para arriendo
            $machine = Machine::find($sel);
            $machine->update([
                'state' => 1,
            ]);
        }

        return redirect()->route('details_loans', ['loan_id' => $request->get('loan_id')])->with('correct', 'Máquina agregada correctamente');

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
        $detail = MachineLoan::find($id);
        $machine = Machine::find($detail->machine_id);
        $loan = Loan::find($detail->loan_id);

        $machine->update([
            'state'     => 0,
        ]);
        $detail->delete();

        return redirect()->route('details_loans', ['loan_id' => $loan->id])->with('correct', 'Máquina eliminada correctamente');

    }
}
