<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

class UserManagement extends Component
{
    public function render()
    {
        $users = User::where('role', '!=', 0)->get();
        return view('livewire.user-management', compact('users'));
    }
}
