<?php

namespace App\Http\Livewire\Admin;

use App\Models\Asset;
use App\Models\Relocation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailsRelocationsIndex extends Component
{
    public $relocation;


    public function render()
    {
        $relocation = Relocation::find($_REQUEST['id']);
        $assets = Asset::where('branch_id', $relocation->origin)
            ->select(DB::raw("CONCAT(id, ' - ', name) AS name_id, id"))
            ->pluck('name_id', 'id');

        $assetsAdd = DB::table('relocation_assets')
            ->join('assets', 'assets.id', '=', 'relocation_assets.asset_id')
            ->select('relocation_assets.*', 'assets.name AS asset_name', 'assets.id AS asset_id')
            ->where('relocation_id', '=', $relocation->id)
            ->paginate();

        $relocation_id = $relocation->id;
        return view('livewire.admin.details-relocations-index', compact('assets', 'relocation_id', 'assetsAdd'));
    }
}
