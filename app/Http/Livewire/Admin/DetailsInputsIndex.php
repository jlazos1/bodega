<?php

namespace App\Http\Livewire\Admin;

use App\Models\DetailsInput;
use App\Models\Input;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DetailsInputsIndex extends Component
{
    use WithPagination;

    public $input;

    protected $paginationTheme = "bootstrap";

    public function mount($input_id)
    {
        $this->input = Input::find($input_id);
    }

    public function render()
    {
        $input = $this->input;
        $products = Product::select(DB::raw("CONCAT(id, ' - ', name) AS name_id, id"))->pluck('name_id', 'id');
        $productsAdd = DB::table('details_inputs')
            ->join('products', 'products.id', '=', 'details_inputs.product_id')
            ->select('details_inputs.*', 'products.name AS product_name')
            ->where('details_inputs.input_id', $this->input->id)
            ->paginate();
        //$productsAdd = DetailsInput::where('input_id');    

        return view('livewire.admin.details-inputs-index', compact('input', 'products', 'productsAdd'));
    }
}
