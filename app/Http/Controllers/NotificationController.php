<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Ticket;
use App\TicketGroup;
use App\Order;
use App\OrderDetail;

use App\Mail\CheckoutSuccess;

use Mail;

use App\Veritrans\Veritrans;

class NotificationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Veritrans::$serverKey = env('VERITRANS_SERVER', '');
        Veritrans::$isProduction = env('APP_ENV', '') == 'production' ? true : false;
    }

    /**
     * Receive payment notification from veritrans.
     *
     * @param  Request  $request
     * @return Response
     *
     * $status
     * 1 = cancelled
     * 2 = denied
     * 3 = success (for credit card)
     * 4 = challenged
     * 5 = settlement
     * 6 = others
     */
    public function payment(Request $request)
    {
        $vt = new Veritrans;

        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if ($result) {
            $notif = $vt->status($result->order_id);

            $order_id           = $notif->order_id;
            $order              = Order::find($order_id);
            $user               = User::find($order->user_id);

            $transaction_status = $notif->transaction_status;
            $payment_type       = $notif->payment_type;
            $fraud_status       = $notif->fraud_status;

            $payment_status = 0;
            $order_status = 0;

            if ($transaction_status == 'capture') {
                if ($payment_type == 'credit_card'){
                    if ($fraud_status == 'challenge') {
                        $payment_status = 4;
                    } 
                    else {
                        $payment_status = 3;
                    }
                }
            }
            else if ($transaction_status == 'settlement') {
                $payment_status = 5;

                $ticket_ids     = json_decode(Redis::get('order:'.$order->user_id))->ticket_ids;

		        if ($ticket_ids != null) {
		        	//update ticket status
		            $tickets_updated = Ticket::whereIn('id', $ticket_ids)
		            ->where('status', 2)
		            ->where('booked_by', $order->user_id)
		            ->update([
		                'status'    => 3,
		                'order_id'  => $order->id,
		            ]);

		            if ($tickets_updated > 0) {
                        $order_status = 2;

			            //send checkout success email
		                Mail::to($user->email)->queue(new CheckoutSuccess);

		                //remove redis
		                Redis::del('order:'.$order->user_id);
		            }
		        }
		        else {
		        	$order_status = 1;
		        }
            }
            else if ($transaction_status == 'deny') {
                $payment_status = 2;
            }
            else if ($transaction_status == 'cancel') {
                $payment_status = 1;
            }
            else {
                $payment_status = 6;
            }

            //update payment status
            $order->update([
            	'order_status'	 => $order_status,
                'payment_status' => $payment_status,
            ]);
        }
    }
}
