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
        // $this->middleware('auth');

        Veritrans::$serverKey = 'VT-server-hDPL0IDkJCWQ44Sp5t3jvDyy';
        Veritrans::$isProduction = false;
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
     * Create order and go to payment page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function pay(Request $request)
    {
    	$order_details 	= json_decode(Redis::get('order_details:'.$request->user()->id));
    	$ticket_ids 	= json_decode(Redis::get('ticket_ids:'.$request->user()->id));
    	$amount 		= json_decode(Redis::get('amount:'.$request->user()->id));

    	$order_id = Order::create([
    		'user_id'	=> $request->user()->id,
            'amount' 	=> $amount,
            'payment_status' => '',
            'payment_type' => '',
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
                'merchant_name'    => $order_detail->event->name,
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
                'finish_redirect_url' => 'http://gethype.dev',
                'unfinish_redirect_url' => 'http://gethype.dev',
                'error_redirect_url' => 'http://gethype.dev'
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
     * Receive payment notification from veritrans.
     *
     * @param  Request  $request
     * @return Response
     */
    public function notify(Request $request)
    {
        $vt = new Veritrans;

        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if ($result) {
            $notif = $vt->status($result->order_id);

            $order_id           = $notif->order_id;
            $transaction_status = $notif->transaction_status;
            $payment_type       = $notif->payment_type;
            $fraud_status       = $notif->fraud_status;

            $payment_status = 'pending';
            if ($transaction_status == 'capture') {
                if ($payment_type == 'credit_card'){
                    if ($fraud_status == 'challenge') {
                        $payment_status = 'challenged';
                    } 
                    else {
                        $payment_status = 'success';
                    }
                }
            }
            else if ($transaction_status == 'settlement') {
                $payment_status = 'settled';
            }
            else if ($transaction_status == 'deny') {
                $payment_status = 'denied';
            }
            else if ($transaction_status == 'cancel') {
                $payment_status = 'cancelled';
            }

            //update status
            $order = Order::find($order_id);
            $order->update([
                'payment_status' => $payment_status,
                'payment_type'  => $payment_type
            ]);

            //send email
            Mail::queue('emails.send', ['title' => 'title', 'content' => 'content'], function ($message)
            {

                $message->from('admin@gethype.com', 'Yonatan Nugraha');
                $message->to('chainfrostx@gmail.com');

            });
        }
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

    }
}
