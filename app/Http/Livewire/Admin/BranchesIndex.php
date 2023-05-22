<?php

namespace App\Http\Livewire\Admin;

use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class BranchesIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $branches = DB::table('branches')
            ->join('cities', 'branches.city_id',  '=', 'cities.id')
            ->select('branches.*', 'cities.name AS city_name')
            ->where('branches.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('cities.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.branches-index', compact('branches'));
    }
}
