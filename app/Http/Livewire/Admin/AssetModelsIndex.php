<?php

namespace App\Http\Livewire\Admin;

use App\Models\AssetModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AssetModelsIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $asset_models = DB::table('asset_models')
            ->leftJoin('asset_types', 'asset_models.asset_type_id', '=', 'asset_types.id')
            ->select('asset_models.*', 'asset_types.name AS asset_type_name')
            ->where('asset_models.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('asset_models.description', 'LIKE', '%' . $this->search . '%')
            ->orWhere('asset_types.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.asset-models-index', compact('asset_models'));
    }
}
