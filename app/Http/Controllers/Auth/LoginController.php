<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view ('auth.login');
    }

    public function auth(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {

            Auth::logoutOtherDevices($request->password);

            if (Auth::user()->type == 0 || Auth::user()->type == 1) {
                $request->session()->regenerate();
                return redirect()->intended('/home');
            }else if (Auth::user()->type == 2) {
                $request->session()->regenerate();
                return redirect()->intended('/consultant');
            }

        }else{
            return back()->withErrors([
                'alert' => trans('auth.failed'),
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
