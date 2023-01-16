<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

use App\Models\User;

class UserManagement extends Component
{
    public function render()
    {
        $users = User::where('role', '!=', 0)->get();
        return view('livewire.user-management', compact('users'));
    }

    public function store(Request $request)
    {

        $name = $request->user_name;
        $email = $request->user_email;
        $password =  Hash::make('secret');
        $role = $request->user_role;

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);

        // redirect to previous page
        return redirect()->back()
            ->with('created', 'Pengguna telah berjaya ditambah');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()
            ->with('deleted', 'Pengguna berjaya dipadam.');
    }
}
