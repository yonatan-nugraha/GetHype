<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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
        Veritrans::$serverKey = 'VT-server-hDPL0IDkJCWQ44Sp5t3jvDyy';
        Veritrans::$clientKey = 'VT-client-H9RQT94F8JCr8hvr';
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
     * 2 = pending
     * 3 = challenged (for credit card)
     * 4 = success (for credit card)
     * 5 = settlement
     * 6 = expired
     * 7 = others
     */
    public function payment(Request $request)
    {
        $vt = new Veritrans;

        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if ($result) {
            $notif  = $vt->status($result->order_id);

            if (!isset($notif->order_id)) {
                return;
            }

            $order  = Order::find($notif->order_id);
            if (count($order) == 0) {
                return;
            }

            $transaction_status = $notif->transaction_status;
            $payment_type       = $notif->payment_type;
            $fraud_status       = $notif->fraud_status;

            $order_status   = ($order->order_status == 2) ? 2 : 1;
            $payment_status = 0;

            if ($transaction_status == 'cancel') {
                $payment_status = 1;
            }
            else if ($transaction_status == 'pending') {
                $payment_status = 2;
            }
            else if ($transaction_status == 'capture') {
                if ($payment_type == 'credit_card'){
                    if ($fraud_status == 'challenge') {
                        $payment_status = 3;
                    } 
                    else {
                        $payment_status = 4;
                    }
                }
            }
            else if ($transaction_status == 'settlement') {
                $payment_status = 5;
            }
            else if ($transaction_status == 'expire') {
                $payment_status = 6;
            }
            else {
                $payment_status = 7;
            }

            if (in_array($payment_status, [4,5]) && $order->order_status != 2) {
                $order_redis    = json_decode(Redis::get('order:'.$order->user_id));
                
                if ($order_redis && $order_redis->order_id == $order->id) {
                    $ticket_ids     = $order_redis->ticket_ids;

                    $tickets_updated = Ticket::whereIn('id', $ticket_ids)
                        ->where('status', 2)
                        ->where('booked_by', $order->user_id)
                        ->update([
                            'status'    => 3,
                            'order_id'  => $order->id,
                        ]);

                    if ($tickets_updated > 0) {
                        $order_status = 2;

                        $user = User::find($order->user_id);
                        Mail::to($order->user->email)->queue(new CheckoutSuccess($user, $order));

                        Redis::del('order:'.$order->user_id);
                    }
                }
            }

            $order->update([
            	'order_status'	 => $order_status,
                'payment_status' => $payment_status,
            ]);
        }
    }
}
