<?php

namespace App\Repositories;

use App\Helpers\Helper;
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
            Helper::toastrError("Old Password is Invalid");
            return back();
        } else if (strcmp($request->get('old_password'), $request->password) == 0)
        {
            Helper::toastrError("New Password cannot be same as your old password.");
            return back();
        }
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        Helper::toastrSuccess("Password has been updated successfully");
        return redirect()->route('change.password');
    }
}
