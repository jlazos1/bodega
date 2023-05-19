<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        /*$users = User::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
            ->paginate()*/;

        $users = DB::table('users')
            ->leftJoin('branches', 'branches.id', '=', 'users.branch_id')
            ->select('users.*', 'branches.name AS branch_name')
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
            ->orWhere('branches.name', 'LIKE', '%' . $this->search . '%')
            ->paginate();   


        return view('livewire.admin.users-index', compact('users'));
    }
}
