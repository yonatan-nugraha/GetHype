<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Order;
use App\OrderDetail;
use App\Ticket;

class TicketController extends Controller
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
    public function index(Request $request) {
    	$orders = $request->user()->orders()->get();

        return view('tickets/index', [
        	'orders' => $orders,
        ]);
    }
}
