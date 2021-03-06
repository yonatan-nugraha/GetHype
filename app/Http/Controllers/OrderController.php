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
            ->where('payment_status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders/index', [
        	'orders' => $orders,
            'bookmarks' => auth()->user()->bookmarks
        ]);
    }
}
