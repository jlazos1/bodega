<?php

namespace App\Http\Livewire\Admin;

use App\Models\AssetModel;
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
        $asset_models = AssetModel::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('description', 'LIKE', '%' . $this->search . '%')
            ->paginate();  

        return view('livewire.admin.asset-models-index', compact('asset_models'));
    }
}
