<?php

namespace App\Http\Livewire\Admin;

use App\Models\Output;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DetailsOutputsIndex extends Component
{
    use WithPagination;

    public $output;

    protected $paginationTheme = "bootstrap";

    public function mount($output_id)
    {
        $this->output = Output::find($output_id);
    }
    
    public function render()
    {
        $output = $this->output;
        $products = Product::select(DB::raw("CONCAT(id, ' - ', name) AS name_id, id"))->pluck('name_id', 'id');
        $productsAdd = DB::table('details_outputs')
            ->join('products', 'products.id', '=', 'details_outputs.product_id')
            ->select('details_outputs.*', 'products.name AS product_name')
            ->where('details_outputs.output_id', $this->output->id)
            ->get();


        return view('livewire.admin.details-outputs-index', compact('output', 'products', 'productsAdd'));
    }
}
