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
            ->join('asset_models', 'asset_models.id', '=', 'assets.asset_model_id')
            ->select('assets.*', 'branches.name AS branch_name', 'asset_models.name AS asset_model_name')
            ->where('assets.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('asset_models.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('branches.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.assets-index', compact('assets'));
    }
}
