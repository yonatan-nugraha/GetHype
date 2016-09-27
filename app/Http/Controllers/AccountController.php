<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use App\EventType;
use App\Interest;

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
    public function index(Request $request)
    {
        $user_interests = array();
        $user_interests_name = array();
        foreach (auth()->user()->interests as $interest) {
            $user_interests[] = $interest->category_id;
            $user_interests_name[] = $interest->category->name;
        }

        return view('account/index', [
        	'categories'   => Category::all(),
            'interests'     => auth()->user()->interests,
            'user_interests' => $user_interests,
            'user_interests_name' => join(', ', $user_interests_name)
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

        $interests = $request->interests;

        if ($interests == '') {
            auth()->user()->interests()->delete();
        }
        else {
            $interests_array    = explode(',', $request->interests);
            $user_interests     = array();

            foreach (auth()->user()->interests as $interest) {
                $user_interests[] = $interest->category_id;
            }

            $delete_interests = array_diff($user_interests, $interests_array);
            $insert_interests = array_diff($interests_array, $user_interests);

            foreach ($delete_interests as $interest) {     
                Interest::where('user_id', auth()->user()->id)
                    ->where('category_id', $interest)
                    ->delete();
            }

            foreach ($insert_interests as $interest) {
                if (count(Category::find($interest)) > 0) {
                    Interest::create([
                        'user_id' => auth()->user()->id,
                        'category_id' => $interest
                    ]);
                }
            }
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

    /**
     * Edit password.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updatePicture(Request $request)
    {   
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $request->photo->move(public_path('/images/users'), md5('user-'.auth()->user()->id).'.jpg');
        }

        return 1;
    }
}
