<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\OtpToken;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $email = $request->email;
        $otp = Helper::generateOtp($request);
        Mail::to($email)->send(new OtpMail($otp));
        return view('auth.login-verification-form', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $otp = $request->otp;
        $email = $request->email;
        $expectedOtp = OtpToken::where('email', $email)->where('status', 'pending')->latest()->first();
        $user = User::where('email', $email)->first();
        if($expectedOtp){
            if($otp == $expectedOtp->otp && $expectedOtp->expires_at > now()){
                Auth::loginUsingId($user->id);
                $expectedOtp->status = 'verified';
                $expectedOtp->save();
                return redirect()->route('home');
            }
            return view('auth.login-verification-form', compact('email'));
        }
        return view('auth.login-verification-form', compact('email'));
    }
}
