<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AssetsIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $assets = DB::table('assets')
            ->join('branches', 'branches.id', '=', 'assets.branch_id')
            ->join('asset_types', 'assets.asset_type_id', '=', 'asset_types.id')
            ->select('assets.*', 'branches.name AS branch_name', 'asset_types.name AS asset_type_name')
            ->where('assets.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('assets.id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('branches.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('asset_types.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.assets-index', compact('assets'));
    }
}
