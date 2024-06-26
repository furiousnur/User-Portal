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
    protected $redirectTo = '/backend/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return redirect()->route('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            Helper::toastrSuccess('Login Successful');
            return redirect()->route('dashboard');
        }else{
            Helper::toastrError('Invalid Credentials');
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        /*$this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $email = $request->email;
        $otp = Helper::generateOtp($request);
        Mail::to($email)->send(new OtpMail($otp));
        return view('auth.login-verification-form', compact('email'));*/
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
        if($expectedOtp && $user){
            if($otp == $expectedOtp->otp && $expectedOtp->expires_at > now()){
                Auth::loginUsingId($user->id);
                $expectedOtp->status = 'verified';
                $expectedOtp->save();
                Helper::toastrSuccess('Login Successful');
                return redirect()->route('dashboard');
            }
            Helper::toastrError('Invalid OTP');
            return view('auth.login-verification-form', compact('email'));
        }
        Helper::toastrError('Invalid User or OTP');
        return view('auth.login-verification-form', compact('email'));
    }
}
