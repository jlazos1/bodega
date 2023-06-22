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
        $search = $this->search;

        $machines = DB::table('machines')
            ->select([
                'machines.*',
                'games_boards.name AS games_board_name',
                DB::raw("CASE WHEN machines.state = 1 THEN 'Arrendada' ELSE branches.name END AS branch_name")
            ])
            ->join('games_boards', 'machines.games_board_id', '=', 'games_boards.id')
            ->join('branches', 'branches.id', '=', 'machines.branch_id')
            ->where(function ($query) use ($search) {
                $query->where('machines.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('games_boards.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('branches.name', 'LIKE', '%' . $search . '%')
                    ->orWhere(function ($query) use ($search) {
                        $query->where('machines.state', 1)
                            ->where('branches.name', 'LIKE', '%' . $search . '%');
                    });
            })
            ->paginate();

        return view('livewire.admin.machines-index', compact('machines'));
    }
}
