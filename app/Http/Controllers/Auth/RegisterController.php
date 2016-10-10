<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;
use App\Mail\ActivateAccount;
use App\Mail\Welcome;

use Mail, Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return validate()->make($data, [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:30',
            'last_name' => 'regex:/^[\pL\s\-]+$/u|max:30',
            'email'     => 'required|email|max:80|unique:users',
            'phone'     => 'required|min:6|max:20',
            'birthdate' => 'required|date',
            'gender'    => 'required|in:1,2',
            'password'  => 'required|min:6|max:255|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user_id = $this->create($request->all())->id;
        $user = User::find($user_id);

        Mail::to($user->email)->queue(new ActivateAccount($user));

        return redirect('login')
            ->withErrors([ 'error' => 'Your account has been created. Please activate it by clicking the link that has been sent to your email.' ])
            ->withInput();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => ucwords($data['first_name']),
            'last_name'  => ucwords($data['last_name']),
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'gender'     => $data['gender'],
            'birthdate'  => $data['birthdate'],
            'password'   => bcrypt($data['password']),
            'status'     => 0,
        ]);
    }

    /**
     * Activate account.
     *
     * @param  Request  $request
     * @return User
     */
    protected function activate(Request $request, User $user)
    {
        if (count($user) == 0) {
            return redirect('');
        }

        $key    = $request->key;
        $lock   = sha1('gethype:'.$user->email);

        if ($key == $lock && $user->status == 0) {
            $user->update([
                'status' => 1,
            ]);

            Mail::to($user->email)->queue(new Welcome);

            return redirect('login')
                ->withErrors([ 'error' => 'Your account has been activated. Please login.' ])
                ->withInput([ 'email' => $user->email ]);
        }

        return redirect('');
    }
}
