<?php

namespace App\Http\Livewire\Admin;

use App\Models\GamesBoard;
use Livewire\Component;
use Livewire\WithPagination;

class GamesBoardsIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {
        $games = GamesBoard::where('name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.games-boards-index', compact('games'));
    }
}
