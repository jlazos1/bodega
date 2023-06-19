<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MachinesIndex extends Component
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
        $machines = DB::table('machines')
            ->select('machines.*', 'games_boards.name AS games_board_name', 'branches.name AS branch_name')
            ->join('games_boards', 'machines.games_board_id', '=', 'games_boards.id')
            ->join('branches', 'branches.id', '=', 'machines.branch_id')
            ->where('machines.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('games_boards.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('branches.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.machines-index', compact('machines'));
    }
}
