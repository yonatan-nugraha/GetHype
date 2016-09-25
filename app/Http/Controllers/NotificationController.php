<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Ticket;
use App\TicketGroup;
use App\Order;
use App\OrderDetail;

use App\Mail\Register;

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

            $transaction_status = $notif->transaction_status;
            $payment_type       = $notif->payment_type;
            $fraud_status       = $notif->fraud_status;

            $payment_status = 0;
            $order_status = 0;

            if ($transaction_status == 'capture') {
                if ($payment_type == 'credit_card'){
                    if ($fraud_status == 'challenge') {
                        $payment_status = 5;
                    } 
                    else {
                        $payment_status = 3;
                    }
                }
            }
            else if ($transaction_status == 'settlement') {
                $payment_status = 4;

                $ticket_ids     = json_decode(Redis::get('ticket_ids:'.$order->user_id));

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
			            //send checkout success email
		                Mail::to('yonatan.nugraha@gethype.co.id')->queue(new Register);

		                //remove redis
		                Redis::del('order_details:'.$order->user_id);
		                Redis::del('ticket_ids:'.$order->user_id);
		                Redis::del('event:'.$order->user_id);
		                Redis::del('amount:'.$order->user_id);
                        Redis::del('total_quantity:'.$order->user_id);

		                $order_status = 2;
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
                'payment_type'   => $payment_type,
            ]);
        }
    }
}
