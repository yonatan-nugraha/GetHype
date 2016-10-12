<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
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
     * Display a list of tickets based on orders.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index() 
    {
    	$orders = auth()->user()->orders()
            ->whereIn('payment_status', [4,5])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders/index', [
        	'orders' => $orders,
            'bookmarks' => auth()->user()->bookmarks
        ]);
    }
}
