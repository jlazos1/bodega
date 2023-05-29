<?php

namespace App\Http\Livewire\Admin;

use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProvidersIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $providers = DB::table('providers')
            ->join('cities', 'providers.city_id', '=', 'cities.id')
            ->select('providers.*', 'cities.name AS city_name')
            ->where('providers.name', 'LIKE', '%' . $this->search . '%')
            ->where('cities.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.providers-index', compact('providers'));
    }
}
