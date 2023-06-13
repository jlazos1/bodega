<?php

namespace App\Http\Livewire\Admin;

use App\Models\Set;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AssetSetsIndex extends Component
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
        $asset_sets = DB::table('sets')
            ->select('sets.*', 'slots.name AS slot_name', 'screen.name AS screen_name', 'pc.name AS pc_name', 'card.name AS card_name')
            ->leftJoin('assets AS slots', 'sets.slot_id', '=', 'slots.id')
            ->leftJoin('assets AS screen', 'sets.screen_id', '=', 'screen.id')
            ->leftJoin('assets AS pc', 'sets.pc_id', '=', 'pc.id')
            ->leftJoin('assets AS card', 'sets.card_id', '=', 'card.id')
            ->where('slots.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('screen.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('pc.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('card.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();

        return view('livewire.admin.asset-sets-index', compact('asset_sets'));
    }
}
