<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Date;

class InputsIndex extends Component
{
    use WithPagination;

    public $search;

    public $from_date = "";
    public $to_date = "";

    protected $paginationTheme = "bootstrap";

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $inputs = DB::table('inputs')
            ->join('providers', 'inputs.provider_id', '=', 'providers.id')
            ->join('document_types', 'inputs.document_type_id', '=', 'document_types.id')
            ->join('branches', 'inputs.branch_id', '=', 'branches.id')
            ->select('inputs.*', 'providers.name AS provider_name', 'document_types.name AS document_type_name', 'branches.name AS branch_name')
            ->where(function ($query) {
                $query->where('providers.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('inputs.doc_number', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('branches.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('document_types.name', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->from_date && $this->to_date, function ($query) {
                $query->whereBetween('inputs.date', [
                    Carbon::parse($this->from_date)->startOfDay(),
                    Carbon::parse($this->to_date)->endOfDay()
                ]);
            })
            ->paginate();

        return view('livewire.admin.inputs-index', compact('inputs'));
    }
}
