<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\ProfileInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileRepository implements ProfileInterface
{
    public function profilePage()
    {
        return User::find(auth()->user()->id);
    }

    public function passwordUpdate($request)
    {
        $auth = Auth::user();
        if (!Hash::check($request->get('old_password'), $auth->password))
        {
            return back()->with('error', "Old Password is Invalid");
        } else if (strcmp($request->get('old_password'), $request->password) == 0)
        {
            return back()->with('error', "New Password cannot be same as your old password.");
        }
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return redirect()->route('change.password')->with('success', 'Password has been updated successfully');
    }
}
