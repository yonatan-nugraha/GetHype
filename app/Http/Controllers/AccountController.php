<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use App\EventType;

use Validator, Input, Redirect;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display edit profile/password form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit(Request $request)
    {
        return view('account/edit', [
        	'categories' => Category::all(),
        	'event_types' => EventType::all()
        ]);
    }

    /**
     * Edit profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users,email,'.$request->user()->id,
            'phone'     => 'required|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/account/settings#edit-profile')
                ->withErrors($validator)
                ->withInput();
        }

        $request->user()->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'gender'        => $request->gender,
            'birthdate'     => $request->birthdate,
        ]);

        return redirect('/account/settings#edit-profile');
    }

    /**
     * Edit password.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $validator->after(function($validator) use ($request) {
            $password_correct = auth()->validate([
                'password' => $request->current_password
            ]);
            if (!$password_correct) {
                $validator->errors()->add('current_password', 'Your current password is incorrect, please try again.');
            }
        });

        if ($validator->fails()) {
            return redirect('/account/settings#change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $request->user()->update([
            'password'  => bcrypt($request->new_password),
        ]);

        return redirect('/account/settings#change-password');
    }
}
