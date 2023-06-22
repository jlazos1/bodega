<?php

namespace App\Http\Livewire\Admin;

use App\Models\Relocation;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class RelocationsIndex extends Component
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
        $relocations = Relocation::join('branches AS ori', 'relocations.origin', '=', 'ori.id')
            ->join('branches AS dest', 'relocations.destination', '=', 'dest.id')
            ->select('relocations.*', 'ori.name AS origin_name', 'dest.name AS destination_name')
            ->where(function ($query) {
                $query->where('ori.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('dest.name', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->from_date && $this->to_date, function ($query) {
                $query->whereBetween('relocations.date', [
                    Carbon::parse($this->from_date)->startOfDay(),
                    Carbon::parse($this->to_date)->endOfDay()
                ]);
            })
            ->orderBy('relocations.id')
            ->paginate();

        return view('livewire.admin.relocations-index', compact('relocations'));
    }
}
