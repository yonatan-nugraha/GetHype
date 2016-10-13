<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;

use Mail;

class MessageController extends Controller
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
     * Store message.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) 
    {
    	$validator = validator()->make($request->all(), [
    		'subject' 		=> 'required|max:80',
    		'content' 	    => 'required|max:500',
    		'first_name'	=> 'required|regex:/^[\pL\s\-]+$/u|min:2|max:50',
            'last_name' 	=> 'regex:/^[\pL\s\-]+$/u|max:50',
            'email'     	=> 'required|email|max:80',
            'phone'     	=> 'max:20',
        ])->validate();

        $subject    = trim($request->subject);
        $content    = trim($request->content);
        $first_name = trim($request->first_name);
        $last_name  = trim($request->last_name);
        $email      = trim($request->email);
        $phone      = trim($request->phone);

    	if ($request->cookie('message') == null) {
	    	Message::create([
	    		'subject' 	=> $subject,
	    		'content' 	=> $content,
	    		'first_name' 	=> $first_name,
	    		'last_name' 	=> $last_name,
	    		'email' 	=> $email,
	    		'phone' 	=> $phone,
	    		'status' 	=> 0,
			]);

            Mail::queue([], [], function ($message) use ($subject, $content, $first_name, $last_name, $email) {
                $message->from($email, $first_name . ' ' . $last_name)
                    ->to('support@gethype.co.id')
                    ->subject($subject)
                    ->setBody($content);
            });

    		$cookie = cookie('message', '1', 2);

    		return response(array(
				'success' => 1,
	    		'message' => 'Your message has been sent'
			))->cookie($cookie);
    	}

    	return response(array(
			'success' => 0,
    		'message' => 'You have just sent a message. Please wait for a while, before sending again.'
		));

    }
}
