<?php

namespace App\Http\Livewire\Admin;

use App\Models\Loan;
use App\Models\Machine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DetailsLoansIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $loan;

    public function mount($loan_id)
    {
        $this->loan = Loan::find($loan_id);
    }

    public function render()
    {
        $loan_id = $this->loan->id;
        $machines = Machine::select(DB::raw("CONCAT(id, ' - ', name) AS name_id, id"))
            ->where('machines.state', 0)
            ->pluck('name_id', 'id');
        $machinesAdd = DB::table('machine_loans')
            ->join('machines', 'machines.id', '=', 'machine_loans.machine_id')
            ->select('machine_loans.*', 'machines.name AS machine_name', 'machines.id AS machine_id')
            ->where('machine_loans.loan_id', $loan_id)
            ->paginate();


        return view('livewire.admin.details-loans-index', compact('loan_id', 'machines', 'machinesAdd'));
    }
}
