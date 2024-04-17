<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    public function index(Request $request)
    {
        return User::latest()->paginate(5);
    }

    public function create(array $data)
    {
        if ($data['id_verification']) {
            $file = $data['id_verification'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        }
         User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'id_verification' => $fileName ?? null,
            'password' => Hash::make($data['password']),
        ]);
        return true;
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return compact('user','roles','userRole');
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function syncRoles($user, array $roles)
    {
        $user->syncRoles($roles);
    }
}
