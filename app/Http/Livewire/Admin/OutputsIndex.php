<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OutputsIndex extends Component
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
        $outputs = DB::table('outputs')
            ->select('outputs.*', 'origin.name AS origin_branch_name', 'destination.name AS destination_branch_name')
            ->join('branches AS origin', 'outputs.origin_branch_id', '=', 'origin.id')
            ->join('branches AS destination', 'outputs.destination_branch_id', '=', 'destination.id')
            ->where(function ($query) {
                $query->where('origin.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('destination.name', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->from_date && $this->to_date, function ($query) {
                $query->whereBetween('outputs.date', [
                    Carbon::parse($this->from_date)->startOfDay(),
                    Carbon::parse($this->to_date)->endOfDay()
                ]);
            })
            ->paginate();

        return view('livewire.admin.outputs-index', compact('outputs'));
    }
}
