<?php

namespace App\Http\Livewire\Admin;

use App\Models\AssetType;
use Livewire\Component;
use Livewire\WithPagination;

class AssetTypesIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $asset_types = AssetType::where('name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.asset-types-index', compact('asset_types'));
    }
}
