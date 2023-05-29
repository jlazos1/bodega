<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTypesIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $product_types = ProductType::where('name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.product-types-index', compact('product_types'));
    }
}
