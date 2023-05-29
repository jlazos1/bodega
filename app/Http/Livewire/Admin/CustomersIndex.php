<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CustomersIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $customers = DB::table('customers')
            ->join('cities', 'customers.city_id', '=', 'cities.id')
            ->select('customers.*', 'cities.name AS city_name')
            ->where('customers.name', 'LIKE', '%' . $this->search . '%')
            ->where('cities.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.customers-index', compact('customers'));
    }
}
