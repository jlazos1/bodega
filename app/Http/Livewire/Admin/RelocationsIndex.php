<?php

namespace App\Http\Livewire\Admin;

use App\Models\Relocation;
use Livewire\Component;
use Livewire\WithPagination;

class RelocationsIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $relocations = Relocation::
            join('branches AS ori', 'relocations.origin', '=', 'ori.id')
            ->join('branches AS dest', 'relocations.destination', '=', 'dest.id')
            ->select('relocations.*', 'ori.name AS origin_name', 'dest.name AS destination_name')
            ->paginate();
            
        return view('livewire.admin.relocations-index', compact('relocations'));
    }
}
