<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function profilePage()
    {
        $user = $this->profileRepository->profilePage();
        return view('backend.pages.profile.profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function changePassword()
    {
        return view('backend.pages.profile.change-password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
        $response = $this->profileRepository->passwordUpdate($request);
        return $response;
    }
}
