<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $products = DB::table('products')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->select('products.*', 'product_types.name AS product_type_name')
            ->where('products.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('products.id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('product_types.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.products-index', compact('products'));
    }
}
