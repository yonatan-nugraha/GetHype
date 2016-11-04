<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator, Redirect, Socialite, Mail;
use Carbon\Carbon;

use App\User;
use App\SocialAccount;
use App\Subscriber;

use App\Mail\Welcome;

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
            'email'     => 'required|email|max:80', 
            'password'  => 'required|alpha_num|min:6|max:255',
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password), $request->remember)) {
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

    /**
     * Handle a login request with social provider.
     *
     * @param  Request  $request
     * @return User
     */
    public function redirectToProvider(Request $request, $provider)
    {
        if ($provider == 'facebook') {
            return Socialite::driver($provider)->scopes([
                'user_birthday'
            ])->redirect();
        }
        return Socialite::driver($provider)
            ->redirect();
    }

    /**
     * Handle a callback from social provider.
     *
     * @param  Request  $request
     * @return User
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        $provider_user;
        $first_name     = '';
        $last_name      = '';
        $birthdate_format = '';
        $birthdate      = '';

        if ($provider == 'facebook') {
            $provider_user = Socialite::with($provider)->fields([
                'name', 'email', 'gender', 'verified', 'first_name', 'last_name', 'birthday'
            ])->user();

            $first_name = $provider_user->user['first_name'];
            $last_name  = $provider_user->user['last_name'];
            $birthdate_format = 'm/d/Y';
            $birthdate  = isset($provider_user->user['birthday']) ? $provider_user->user['birthday'] : '01/01/1991';
        }
        else if ($provider == 'google') {
            $provider_user = Socialite::with($provider)->user();

            $first_name = $provider_user->user['name']['givenName'];
            $last_name  = $provider_user->user['name']['familyName'];
            $birthdate_format = 'Y-m-d';
            $birthdate  = isset($provider_user->user['birthday']) ? $provider_user->user['birthday'] : '1991-01-01';
        }
        else {
            return redirect('');
        }

        $provider_user_id  = $provider_user->id;
        $email      = $provider_user->email;
        $gender     = ($provider_user->user['gender'] == 'male') ? 1 : 2;

        $valid_date = $birthdate ? Carbon::createFromFormat($birthdate_format, $birthdate) : '';
        if ($valid_date && $valid_date->format($birthdate_format) == $birthdate) {
            if ($valid_date->year) {
                $birthdate = $valid_date->toDateString();
            }
            else {
                $birthdate = Carbon::createFromFormat('Y-m-d', '1991-'.$valid_date->month.'-'.$valid_date->day)->toDateString();
            }
        } else {
            $birthdate = '1991-01-01';
        }

        if ($provider_user_id) {
            $social_account = SocialAccount::where('provider', $provider)
                ->where('provider_user_id', $provider_user_id)
                ->first();

            if ($social_account) {
                auth()->loginUsingId($social_account->user_id, true);

                return redirect()->intended('/home');
            } 
            else {
                $user = User::where('email', $email)->first();

                if (!$user) {
                    $user = User::create([
                        'first_name' => ucwords(trim($first_name)),
                        'last_name' => ucwords(trim($last_name)),
                        'email'     => trim($email),
                        'phone'     => '',
                        'gender'    => $gender,
                        'birthdate' => $birthdate,
                        'password'  => '',
                        'status'    => 1,
                    ]);
                }

                SocialAccount::create([
                    'user_id'       => $user->id,
                    'provider_user_id' => $provider_user_id,
                    'provider'      => $provider,
                ]);

                $subscriber = Subscriber::where('email', $user->email)->first();
                if (!$subscriber) {
                    Subscriber::create([
                        'email'     => $user->email,
                        'status'    => 1,
                    ]);   
                }
                else {
                    $subscriber->update([
                        'status' => 1
                    ]);
                }

                Mail::to($user->email)->queue(new Welcome);

                auth()->login($user, true);

                return redirect()->intended('/home');
            }
        }
    }
}
