<?php

namespace App\Http\Livewire\Admin;

use App\Models\Branch;
use App\Models\DocumentType;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class InputCreate extends Component
{
    use WithPagination;

    public $search, $input;

    public $productsAdd = [], $productSelect;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $providers = Provider::pluck('name', 'id');
        $doc_types = DocumentType::pluck('name', 'id');
        $branches = Branch::pluck('name', 'id');
        $productsAdd = $this->productsAdd;

        return view('livewire.admin.input-create', compact('providers', 'doc_types', 'productsAdd', 'branches'));
    }

    public function addProduct(){        
        $this->productsAdd[] = $this->productSelect;

    }

    public function updatingProductSelect($id)
    {
        $this->productSelect = Product::find($id);
    }
}
