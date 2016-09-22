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

use App\Veritrans\Veritrans;

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

        Veritrans::$serverKey = env('VERITRANS_SERVER', '');
        Veritrans::$isProduction = env('APP_ENV', '') == 'production' ? true : false;
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
        $event         = json_decode(Redis::get('event:'.$request->user()->id));
    	$amount        = json_decode(Redis::get('amount:'.$request->user()->id));
        $total_quantity = json_decode(Redis::get('total_quantity:'.$request->user()->id));

        if ($order_details == null) {
            return redirect('');
        }

        return view('checkout/index', [
        	'order_details' => $order_details,
            'event'         => $event,
        	'amount' 		=> $amount,
            'total_quantity' => $total_quantity
        ]);
    }

    /**
     * Create order and go to veritrans payment page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function pay(Request $request)
    {
    	$order_details 	= json_decode(Redis::get('order_details:'.$request->user()->id));
        $event          = json_decode(Redis::get('event:'.$request->user()->id));
    	$amount 		= json_decode(Redis::get('amount:'.$request->user()->id));

    	$order_id = Order::create([
    		'user_id'	=> $request->user()->id,
            'event_id'  => $event->id,
            'amount' 	=> $amount,
            'order_status' => 0,
        ])->id;

        $items = array();
    	foreach ($order_details as $order_detail) {
    		OrderDetail::create([
	            'order_id' 			=> $order_id,
	            'ticket_group_id' 	=> $order_detail->ticket_group->id,
	            'quantity'			=> $order_detail->quantity,
	        ]);

            $item = array(
                'id'       => $order_detail->ticket_group->id,
                'price'    => $order_detail->ticket_group->price,
                'quantity' => $order_detail->quantity,
                'name'     => $order_detail->ticket_group->name,
            );

            $items[] = $item;
    	}

        $transaction_data = array(
            'payment_type' => 'vtweb',
            'transaction_details' => array(
                'order_id'    => $order_id,
                'gross_amount'  => $amount,
            ),
            'vtweb' => array(
                'enabled_payments' => array('bca_klikpay'),
                'credit_card_3d_secure' => true,
            ),
            'customer_details' => array(
                'first_name' => $request->user()->name,
                'email' => $request->user()->email,
                'phone' => '081122334455',
            ),
            'item_details'  => $items,
        );

        $vt = new Veritrans;
        $vtweb_url = $vt->vtweb_charge($transaction_data);

        return redirect($vtweb_url);
    }

    /**
     * Display checkout success page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function success(Request $request)
    {
        $order_id = $request->order_id;
        $order = Order::find($order_id);

    	if ($order->user_id != $request->user()->id) {
    		return redirect('');
    	}

    	$order_details = $order->order_details()->get();

        return view('checkout/success', [
        	'order_details' => $order_details
        ]);
    }

    /**
     * Display checkout failed page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function failed(Request $request)
    {
        //send checkout success email
        Mail::send('emails.send', ['title' => '', 'content' => ''], function ($message)
        {
            $message->from('yonatan.nugraha@gethype.co.id', 'Yonatan Nugraha');
            $message->to('yonatan.nugraha@gethype.co.id');
            $message->subject('Test Email');
        });
    }
}
