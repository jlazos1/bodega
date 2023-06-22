<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\Machine;
use App\Models\MachineLoan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.loans.index')->only('index');
        $this->middleware('can:admin.loans.create')->only('create', 'store');
        $this->middleware('can:admin.loans.edit')->only('edit', 'update');
        $this->middleware('can:admin.loans.show')->only('show');

    }

    public function index()
    {
        return view('admin.loans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::pluck('name', 'id');

        return view('admin.loans.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'       => 'required',
            'loan_date'         => 'required',
            'return_date'       => 'required|after:loan_date',
            'amount'            => 'required'
        ], [
            'customer_id.required'      => 'El campo Cliente es obligatorio',
            'loan_date.required'        => 'El campo Fecha Inicial es obligatorio',
            'return_date.required'      => 'El campo Fecha Final es obligatorio',
            'return_date.after'         => 'La fecha de devolución debe ser posterior a la fecha inicial',
            'amount.required'           => 'El campo Monto es obligatorio',
        ]);
        $loan = new Loan([
            'customer_id'       => $request->get('customer_id'),
            'loan_date'         => $request->get('loan_date'),
            'return_date'       => $request->get('return_date'),
            'amount'            => $request->get('amount'),
            'loan_state_id'     => 1,
        ]);
        $loan->save();
        $loan_id = $loan->id;
        return redirect()->route('details_loans', ['loan_id' => $loan_id]);
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
        $customers = Customer::pluck('name', 'id');
        $loan = Loan::find($id);

        return view('admin.loans.edit', compact('customers', 'loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'loan_date'         => 'required',
            'return_date'       => 'required|after:loan_date',
            'amount'            => 'required'
        ], [
            'loan_date.required'        => 'El campo Fecha Inicial es obligatorio',
            'return_date.required'      => 'El campo Fecha Final es obligatorio',
            'return_date.after'         => 'La fecha de devolución debe ser posterior a la fecha inicial',
            'amount.required'           => 'El campo Monto es obligatorio',
        ]);

        $loan->update([
            'loan_date'         => $request->get('loan_date'),
            'return_date'       => $request->get('return_date'),
            'amount'            => $request->get('amount'),
        ]);

        $loan_id = $loan->id;
        return redirect()->route('details_loans', ['loan_id' => $loan_id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkReturn(){
        $loans = Loan::where('loan_state_id', 1)->get();

        foreach ($loans as $loan) {
            if ($loan->return_date < Carbon::now()) {
                $loan->update([
                    'loan_state_id' => 2,
                ]);          
            }
        }

        return redirect()->route('admin.loans.index');
    }

    public function finishLoan(string $loan_id){
        $loan = Loan::find($loan_id);
        $loan->update([
            'loan_state_id' => 3,
        ]);
        $detalles = MachineLoan::where('loan_id', $loan->id)->get();
        foreach ($detalles as $det) {
            $machine = Machine::find($det->machine_id);
            $machine->update([
                'state' => 0,
            ]);
        }

        return redirect()->route('admin.loans.index');
    }
}
