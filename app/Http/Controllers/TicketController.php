<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use PDF;
use App\Order;
use App\OrderDetail;
use App\Ticket;
use App\Bookmark;

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
    public function index() {
    	$orders = auth()->user()->orders()
            ->where('order_status', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tickets/index', [
        	'orders' => $orders,
            'bookmarks' => auth()->user()->bookmarks
        ]);
    }

    /**
     * Display order invoice.
     *
     * @param  Request  $request
     * @return Response
     */
    public function invoice(Request $request, Order $order) {
        if ($order->user_id != auth()->user()->id) {
            return redirect('');
        }

        // return view('pdfs.invoice', ['order' => $order]);

        $pdf = PDF::loadView('pdfs.invoice', ['order' => $order])->setPaper('a4');

        return $pdf->stream('invoice.pdf');
    }

    /**
     * Display print tickets.
     *
     * @param  Request  $request
     * @return Response
     */
    public function ticket(Request $request, Order $order) {
        if ($order->user_id != auth()->user()->id) {
            return redirect('');
        }

        $tickets = Ticket::where('order_id', $order->id)->get();

        // return view('pdfs.ticket', [
        //     'order' => $order,
        //     'tickets'   => $tickets
        // ]);

        $pdf = PDF::loadView('pdfs.ticket', [
            'order'     => $order,
            'tickets'   => $tickets
        ])->setPaper('a4');

        return $pdf->stream('ticket.pdf');
    }
}
