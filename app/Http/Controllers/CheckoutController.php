<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use App\Http\Requests;

use App\User;
use App\Ticket;
use App\TicketGroup;
use App\Order;
use App\OrderDetail;

use App\Mail\CheckoutSuccess;

use Mail, PDF;

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
        $this->middleware('auth')->except(['pay', 'proceed']);

        Veritrans::$serverKey = 'VT-server-hDPL0IDkJCWQ44Sp5t3jvDyy';
        Veritrans::$clientKey = 'VT-client-H9RQT94F8JCr8hvr';
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
        $order = json_decode(Redis::get('order:'.auth()->id()));

        if ($order == null) {
            return redirect('');
        }

        $remaining_time = Redis::ttl('order:'.auth()->id());

        return view('checkout/index', [
        	'order_details' => $order->order_details,
            'event'         => $order->event,
        	'order_amount'  => $order->order_amount,
            'total_quantity' => $order->total_quantity,
            'remaining_time' => $remaining_time,
            'client_key'    => Veritrans::$clientKey,
            'snap_js_url'   => Veritrans::getSnapJsUrl()
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
        if (auth()->guest()) {
            session()->put('url.intended', '/checkout');

            return array(
                'success' => 0,
                'login'   => 0
            );
        }

        $order_redis    = json_decode(Redis::get('order:'.auth()->id()));
        $remaining_time = Redis::ttl('order:'.auth()->id());

        if ($order_redis == null || $order_redis->order_amount == 0) {
            return array(
                'success' => 0
            );
        }

        $validator = validator()->make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:30',
            'last_name' => 'regex:/^[\pL\s\-]+$/u|max:30',
            'email'     => 'required|email|max:80',
            'phone'     => 'required|min:6|max:20',
        ]);

        $payment_method = $request->payment_method;
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

        $validator->after(function($validator) use ($request, $payment_method, $payment_fees) {
            if ($payment_method == '' || $payment_fees[$payment_method] == 0) {
                $validator->errors()->add('error', 'Please select one of the payment options to proceed.');
            }
        });

        if ($validator->fails()) {
            $validator->validate();
        }

        $event          = $order_redis->event;
        $order_amount   = $order_redis->order_amount;
        $administration_fee = $payment_fees[$payment_method];
        $payment_amount = $order_amount + $administration_fee;

    	$order_id = Order::create([
    		'user_id'	    => auth()->id(),
            'event_id'      => $event->id,
            'order_status'  => 0,
            'order_amount' 	=> $order_amount,
            'administration_fee' => $administration_fee,
            'payment_status' => 0,
            'payment_amount'=> $payment_amount,
            'payment_method' => $payment_method,
            'refund_status' => 0,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
        ])->id;

        $items = array();
    	foreach ($order_redis->order_details as $order_detail) {
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

        $item = array(
            'id'       => 0,
            'price'    => $administration_fee,
            'quantity' => 1,
            'name'     => 'Administration Fee',
        );

        $items[] = $item;

        $order_redis->order_id = $order_id;
        Redis::set('order:'.auth()->id(), json_encode($order_redis));
        Redis::expire('order:'.auth()->id(), $remaining_time);

        $transaction_data = array(
            'enabled_payments' => array($payment_method),
            'transaction_details' => array(
                'order_id'    => $order_id,
                'gross_amount'  => $payment_amount,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
            ),
            'item_details'  => $items,
        );

        $vt = new Veritrans;

        return array(
            'success'   => 1,
            'order_id' => $order_id,
            'token'     => $vt->getSnapToken($transaction_data)
        );
    }

    /**
     * Create order and finish.
     *
     * @param  Request  $request
     * @return Response
     */
    public function proceed(Request $request)
    {
        if (auth()->guest()) {
            session()->put('url.intended', '/checkout');

            return array(
                'success' => 0,
                'login'   => 0
            );
        }

        $order_redis = json_decode(Redis::get('order:'.auth()->id()));

        if ($order_redis == null || $order_redis->order_amount > 0) {
            return array(
                'success' => 0
            );
        }

        $validator = validator()->make($request->all(), [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:30',
            'last_name' => 'regex:/^[\pL\s\-]+$/u|max:30',
            'email'     => 'required|email|max:80',
            'phone'     => 'required|min:6|max:20',
        ]);

        if ($validator->fails()) {
            $validator->validate();
        }

        $event          = $order_redis->event;
        $order_amount   = $order_redis->order_amount;
        $ticket_ids     = $order_redis->ticket_ids;
        $administration_fee = 0;
        $payment_amount = $order_amount + $administration_fee;
        $payment_method = 'free';

        $order_id = Order::create([
            'user_id'       => auth()->id(),
            'event_id'      => $event->id,
            'order_status'  => 0,
            'order_amount'  => $order_amount,
            'administration_fee' => $administration_fee,
            'payment_status' => 0,
            'payment_amount'=> $payment_amount,
            'payment_method'=> $payment_method,
            'refund_status' => 0,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
        ])->id;

        foreach ($order_redis->order_details as $order_detail) {
            OrderDetail::create([
                'order_id'          => $order_id,
                'ticket_group_id'   => $order_detail->ticket_group->id,
                'quantity'          => $order_detail->quantity,
            ]);
        }

        $tickets_updated = Ticket::whereIn('id', $ticket_ids)
        ->where('status', 2)
        ->where('booked_by', auth()->id())
        ->update([
            'status'    => 3,
            'order_id'  => $order_id,
        ]);

        if ($tickets_updated > 0) {
            $order  = Order::find($order_id);
            $order->update([
                'order_status'   => 2,
                'payment_status' => 5,
            ]);

            $user = User::find(auth()->id());
            Mail::to(auth()->user()->email)->queue(new CheckoutSuccess($user, $order));
            Redis::del('order:'.auth()->id());
        }        

        return array(
            'success' => 1,
            'order_id' => $order_id
        );
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
            ->where('order_status', '!=', 0)
            ->whereIn('payment_status', [0,2,4,5])
            ->where('user_id', auth()->id())
            ->first();

    	if (count($order) == 0) {
            return redirect('checkout/failed?order_id='.$order_id);		
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
            ->whereIn('order_status', [0,1])
            ->where('user_id', auth()->id())
            ->first();

        if (count($order) == 0 || in_array($order->payment_status, [1,2,3,7])) {
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
        $order_status       = 1;
        $payment_status     = 5;

        $order  = Order::find($request->order_id);
        if (count($order) == 0 || (count($order) > 0 && $order->order_status == 2)) {
            return redirect('');
        }

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

        $order->update([
            'order_status'   => $order_status,
            'payment_status' => $payment_status,
        ]);

        return redirect('checkout/success?order_id='.$order->id);
    }
}
