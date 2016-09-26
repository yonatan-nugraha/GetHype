<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use App\Http\Requests;

use App\Ticket;
use App\TicketGroup;
use App\Order;
use App\OrderDetail;

use App\Mail\Welcome;
use App\Mail\ActivateAccount;

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

        if ($order_details == null) {
            return redirect('');
        }

        $payment_fees = array(
            'bank_transfer'     => 4900,
            'credit_card'       => 5000,
            'bca_klikpay'       => 2000,
            'mandiri_clickpay'  => 5000,
            'cimb_clicks'       => 5000,
            'epay_bri'          => 5000,
            'mandiri_ecash'     => 4000,
            'indosat_dompetku'  => 3000,
            'telkomsel_cash'    => 3000,
            'xl_tunai'          => 3000,
        );

        $payment_type = $request->payment_type;
        if ($payment_type == '' || $payment_fees[$payment_type] == 0) {
            return redirect('');
        }

    	$order_id = Order::create([
    		'user_id'	=> $request->user()->id,
            'event_id'  => $event->id,
            'amount' 	=> $amount,
            'order_status' => 0,
            'payment_status' => 0,
            'payment_type' => $payment_type,
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
        $order = Order::where('id', $order_id)
                ->where('order_status', 2)
                ->where('user_id', $request->user()->id)
                ->first();

    	if (count($order) == 0) {
    		return redirect('');
    	}

        return view('checkout/success', [
        	'order' => $order
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
        $order_id = $request->order_id;
        $order = Order::where('id', $order_id)
                ->where('order_status', 1)
                ->where('user_id', $request->user()->id)
                ->first();

        if (count($order) == 0) {
            return redirect('');
        }

        return view('checkout/failed', [
            'order' => $order
        ]);
    }

    /**
     * Bypass payment success.
     *
     * @param  Request  $request
     * @return Response
     */
    public function bypass(Request $request)
    {
        $order_id           = $request->order_id;
        $order              = Order::find($order_id);

        $payment_status     = 5;
        $order_status       = 0;

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
                Mail::queue('emails.send', ['title' => '', 'content' => ''], function ($message)
                {
                    $message->from('yonatan.nugraha@gethype.co.id', 'Yonatan Nugraha');
                    $message->to('yonatan.nugraha@gethype.co.id');
                    $message->subject('Test Email');
                });

                //remove redis
                Redis::del('order_details:'.$order->user_id);
                Redis::del('ticket_ids:'.$order->user_id);
                Redis::del('event:'.$order->user_id);
                Redis::del('amount:'.$order->user_id);
                Redis::del('total_quantity:'.$order->user_id);

                $order_status = 2;
            }

            //update payment status
            $order->update([
                'order_status'   => $order_status,
                'payment_status' => $payment_status,
            ]);

            //send email
            Mail::to('yonatan.nugraha@gethype.co.id')->queue(new Register);
        }

        return redirect('checkout/success?order_id='.$order_id);
    }

    /**
     * Test send email.
     *
     * @param  Request  $request
     * @return Response
     */
    public function sendEmail(Request $request)
    {
        // send checkout success email
        Mail::to('yonatan.nugraha@gethype.co.id')->queue(new ActivateAccount(auth()->user()));

        dd('ooo yeahhh');
        // return view('emails.activate_account');
    }
}
