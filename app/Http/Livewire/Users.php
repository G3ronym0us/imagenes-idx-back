<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;

    public function render()
    {
        $this->users = User::get();
        return view('livewire.users');
    }

    public function editUser($id){
        return redirect("users/edit/{$id}");
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        $this->users = User::get();
    }
}
