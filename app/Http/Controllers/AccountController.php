<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use App\EventType;
use App\Interest;

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
        $user_interests = auth()->user()->interests->pluck('category_id')->toArray();
        
        $user_interests_name = array();
        foreach (auth()->user()->interests as $interest) {
            $user_interests_name[] = $interest->category->name;
        }

        return view('account/settings', [
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
        $validator = validator()->make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:30',
            'last_name' => 'regex:/^[\pL\s\-]+$/u|max:30',
            'email'     => 'required|email|max:80|unique:users,email,'.$request->user()->id,
            'phone'     => 'required|min:6|max:20',
            'birthdate' => 'required|date',
            'gender'    => 'required|in:1,2'
        ])->validate();

        $interests = $request->interests;

        if ($interests == '') {
            auth()->user()->interests()->delete();
        }
        else {
            $interests_array    = explode(',', $request->interests);
            $user_interests     = auth()->user()->interests->pluck('category_id')->toArray();

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
            'first_name'    => ucwords(trim($request->first_name)),
            'last_name'     => ucwords(trim($request->last_name)),
            'email'         => trim($request->email),
            'phone'         => trim($request->phone),
            'gender'        => $request->gender,
            'birthdate'     => $request->birthdate,
        ]);

        return redirect('/account/settings');
    }

    /**
     * Edit password.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updatePassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'current_password' => 'required|alpha_num|min:6|max:255',
            'new_password' => 'required|alpha_num|min:6|max:255|confirmed',
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
            'password'  => bcrypt(trim($request->new_password)),
        ]);

        return redirect('/account/settings#change-password');
    }

    /**
     * Edit profile picture.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updatePicture(Request $request)
    {   
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $validator = validator()->make($request->all(), [
                'photo' => 'mimes:jpeg,png,bmp'
            ]);

            if ($validator->fails()) {
                return 0;
            }

            $request->photo->move(public_path('/images/users'), md5('user-'.auth()->id()).'.jpg');
        }

        return 1;
    }
}
