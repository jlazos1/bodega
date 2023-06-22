<?php

namespace App\Http\Livewire\Admin;

use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LoansIndex extends Component
{
    use WithPagination;

    public $search;

    public $from_date = "";
    public $to_date = "";

    protected $paginationTheme = "bootstrap";

    public function updated()
    {
        $this->resetPage();
    }
    
    public function render()
    {

        $search = $this->search;

        $loans = DB::table('loans')
            ->join('customers', 'loans.customer_id', '=', 'customers.id')
            ->join('loan_states', 'loans.loan_state_id', '=', 'loan_states.id')
            ->select('loans.*', 'customers.name AS customer_name','loan_states.name AS loan_state_name')
            ->where(function ($query) use ($search) {
                $query->where('customers.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('loan_states.name', 'LIKE', '%' . $search . '%');
            })
            ->paginate();

        return view('livewire.admin.loans-index', compact('loans'));
    }
}
