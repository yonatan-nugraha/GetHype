<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator, Redirect;
use Carbon\Carbon;

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
     * Where to redirect users after login / registration.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  Request  $request
     * @return User
     */
    protected function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email', 
            'password'  => 'required|min:6',
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            if (auth()->user()->status == 0) {
                auth()->logout();
                return back()
                    ->withErrors([ 'error' => 'Please activate your account by clicking the link that has been sent to your email.' ])
                    ->withInput();
            }

            return redirect()->intended('/home');
        } else {
            return back()
                ->withErrors([ 'error' => 'Incorrect email address or password.' ])
                ->withInput();
        }
    }
}
