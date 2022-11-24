<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function authenticated()
    {
        if (Auth::check()) {
            if (Auth::user()->status == "1") {
                if (Auth::user()->role_as == '1') {
                    return redirect('dashboard')->with('status', 'Welcome to your dashboard');
                } elseif (Auth::user()->role_as == '0') {
                    return redirect('/home')->with('status', 'Login Success');
                }
            } else {
                return redirect('payment')->with('status', 'Please Subscribe to access videos');
            }
        } else {
            return redirect('login')->with('status', 'Please Subscribe to access videos');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
