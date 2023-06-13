<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StockBranchIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $products_branch = DB::table('product_branches')
            ->select('product_branches.*', 'branches.name AS branch_name', 'products.name AS product_name')
            ->join('products', 'products.id', '=', 'product_branches.product_id')
            ->join('branches', 'branches.id', '=', 'product_branches.branch_id')
            ->where('quantity', '>', 0)
            ->where(function ($query) {
                $query
                    ->Where('branches.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('products.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('products.id', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('product_branches.product_id')
            ->paginate();
        return view('livewire.admin.stock-branch-index', compact('products_branch'));
    }
}
