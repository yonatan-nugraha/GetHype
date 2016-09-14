<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use App\Http\Requests;

use App\Ticket;
use App\TicketGroup;
use App\Order;
use App\OrderDetail;

use Mail;

class CheckoutController extends Controller
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
     * Display order detail.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
    	$order_details = json_decode(Redis::get('order_details:'.$request->user()->id));
    	$amount = json_decode(Redis::get('amount:'.$request->user()->id));

        return view('checkout/index', [
        	'order_details' => $order_details,
        	'amount' 		=> $amount
        ]);
    }

    /**
     * Create order and update ticket status.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    	$order_details 	= json_decode(Redis::get('order_details:'.$request->user()->id));
    	$ticket_ids 	= json_decode(Redis::get('ticket_ids:'.$request->user()->id));
    	$amount 		= json_decode(Redis::get('amount:'.$request->user()->id));

    	$order_id = Order::create([
    		'user_id'	=> $request->user()->id,
            'amount' 	=> $amount,
        ])->id;

    	$amount = 0;
    	foreach ($order_details as $order_detail) {
    		OrderDetail::create([
	            'order_id' 			=> $order_id,
	            'ticket_group_id' 	=> $order_detail->ticket_group->id,
	            'quantity'			=> $order_detail->quantity,
	        ]);
    	}

        return redirect('checkout/'.$order_id.'/success');
    }

    /**
     * Display order detail on checkout success.
     *
     * @param  Request  $request
     * @return Response
     */
    public function success(Request $request, Order $order)
    {
    	if ($order->user_id != $request->user()->id) {
    		return redirect('');
    	}

    	Mail::queue('emails.send', ['title' => 'title', 'content' => 'content'], function ($message)
        {

            $message->from('admin@gethype.com', 'Yonatan Nugraha');
            $message->to('chainfrostx@gmail.com');

        });

    	$order_details = $order->order_details()->get();

        return view('checkout/success', [
        	'order_details' => $order_details
        ]);
    }
}
