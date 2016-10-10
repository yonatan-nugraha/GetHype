<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Subscribe to mailing list.
     *
     * @param  Request  $request
     * @return Response
     */
    public function subscribe(Request $request)
    {   
        $validator = validator()->make($request->all(), [
            'email' => 'required|email|max:80',
        ])->validate();

        $email = $request->email;

        $subscriber = Subscriber::where('email', $email);
        if (count($subscriber->get()) == 0) {
	        Subscriber::create([
	        	'email' 	=> $email,
	        	'status' 	=> 1,
	        ]);   
	    }
	    else {
        	$subscriber->update([
        		'status' => 1
        	]);
	    }

        return array(
            'success' => 1,
            'message' => 'Your email has been subscribed to our mailing list.'
        );
    }

    /**
     * Unsubscribe from mailing list.
     *
     * @param  Request  $request
     * @return Response
     */
    public function unsubscribe(Request $request, Subscriber $subscriber)
    {   
    	if (count($subscriber) == 0) {
            return redirect('');
        }

        $key    = $request->key;
        $lock   = sha1('gethype:'.$subscriber->email);

        if ($key == $lock) {
            $subscriber->update([
                'status' => 0,
            ]);
        }

        return redirect('');
    }


}
