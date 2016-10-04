<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Event;
use App\Category;
use App\EventType;
use App\TicketGroup;
use App\Ticket;
use App\OrderDetail;
use App\Order;
use App\Bookmark;
use App\View;

use DB, Carbon\Carbon;

class MyEventController extends Controller
{

    protected $orders_limit = 3;

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
     * Display my list of events.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showList(Request $request)
    {   
        $events = auth()->user()->events()->get();

        if (count($events) == 0) {
        	return redirect('');
        }

        return view('myevents/index', [
        	'events' => $events
        ]);
    }

    /**
     * Display my event details.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showDetail(Request $request, Event $event)
    {   
    	if ($event->user_id != auth()->user()->id) {
    		return redirect('');
    	}

        $total_views = View::select(DB::raw('count(*) as total_views'))
            ->where('event_id', $event->id)
            ->pluck('total_views');

		$order_details = Order::select(DB::raw('SQL_CALC_FOUND_ROWS *, orders.id, contacts.first_name, contacts.last_name, contacts.email, ticket_groups.name, order_details.quantity, orders.created_at, ticket_groups.price'))
		        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
		        ->join('ticket_groups', 'ticket_groups.id', '=', 'order_details.ticket_group_id')
		        ->join('contacts', 'contacts.id', '=', 'orders.contact_id')
		        ->where('orders.event_id', $event->id)
				->where('orders.order_status', 2)
                ->take($this->orders_limit)
		        ->get();

        $total_orders = DB::select(DB::raw('select found_rows() as total_orders'));

		$ticket_sales = TicketGroup::select(DB::raw('ticket_groups.name, sum(case orders.order_status when 2 then order_details.quantity else 0 end) as tickets_sold, (select count(*) from tickets where tickets.ticket_group_id = ticket_groups.id) as total_tickets, ticket_groups.price'))
		        ->leftJoin('order_details', 'ticket_groups.id', '=', 'order_details.ticket_group_id')
		        ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
		        ->where('ticket_groups.event_id', $event->id)
		        ->groupBy('ticket_groups.id')
		        ->get();

		$total_tickets_sold = 0;
		$total_revenue 		= 0;
		
		foreach ($ticket_sales as $ts) {
			$total_tickets_sold += $ts->tickets_sold;
			$total_revenue 		+= $ts->tickets_sold * $ts->price;
		}

		$total_cost 		= 0.1 * $total_revenue;
		$total_profit 		= $total_revenue - $total_cost;

        return view('myevents/show', [
        	'event' 		=> $event,
            'total_views'   => $total_views[0],
        	'ticket_sales' 	=> $ticket_sales,
        	'order_details' => $order_details,
        	'total_tickets_sold' => $total_tickets_sold,
        	'total_revenue' => $total_revenue,
        	'total_cost' 	=> $total_cost,
        	'total_profit' 	=> $total_profit,
            'total_orders'  => $total_orders[0]->total_orders,
            'orders_limit'  => $this->orders_limit,
        ]);
    }

    /**
     * Show event view statistic.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showEventViewStatistic(Request $request, Event $event)
    {   
    	if ($event->user_id != auth()->user()->id) {
    		return redirect('');
    	}

        $views = View::select(DB::raw('date(created_at) as date, count(*) as views'))
            ->where('event_id', $event->id)
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->groupBy('date')
            ->pluck('views', 'date')
            ->toArray();

        $total_views = View::select(DB::raw('count(*) as total_views'))
            ->where('event_id', $event->id)
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->pluck('total_views');

        return array(
            'views'      => $views,
            'total_views' => $total_views,
        );
    }

    /**
     * Show event view statistic by gender.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showEventViewStatisticByGender(Request $request, Event $event)
    {   
    	if ($event->user_id != auth()->user()->id) {
    		return redirect('');
    	}

        $views = View::select(DB::raw('(case users.gender when 1 then "male" else "female" end) as gender, count(*) as views'))
        	->join('users', 'views.user_id', '=', 'users.id')
            ->where('views.event_id', $event->id)
            ->whereDate('views.created_at', '>=', $request->start_date)
            ->whereDate('views.created_at', '<=', $request->end_date)
            ->groupBy('users.gender')
            ->pluck('views', 'gender')
            ->toArray();

        return $views;
    }

    /**
     * Show event view statistic by age.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showEventViewStatisticByAge(Request $request, Event $event)
    {   
    	if ($event->user_id != auth()->user()->id) {
    		return redirect('');
    	}

        $views = View::select(DB::raw('(case 
        	when timestampdiff(year, users.birthdate, now()) <= 17 then "< 17"
        	when timestampdiff(year, users.birthdate, now()) between 18 and 23 then "18-23"
			when timestampdiff(year, users.birthdate, now()) between 24 and 34 then "24-34"
			when timestampdiff(year, users.birthdate, now()) between 35 and 44 then "35-44"
			when timestampdiff(year, users.birthdate, now()) >= 45 then "45+"
			end) as age_group, count(*) as views'))
        	->join('users', 'views.user_id', '=', 'users.id')
            ->where('views.event_id', $event->id)
            ->whereDate('views.created_at', '>=', $request->start_date)
            ->whereDate('views.created_at', '<=', $request->end_date)
            ->groupBy('age_group')
            ->pluck('views', 'age_group')
            ->toArray();

        return $views;
    }

    /**
     * Show ticket statistic.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showTicketStatistic(Request $request, Event $event)
    {   
    	if ($event->user_id != auth()->user()->id) {
    		return redirect('');
    	}

        $orders = Order::select(DB::raw('date(orders.created_at) as date, sum(order_details.quantity) as orders'))
        	->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.event_id', $event->id)
            ->whereDate('orders.created_at', '>=', $request->start_date)
            ->whereDate('orders.created_at', '<=', $request->end_date)
            ->where('orders.order_status', 2)
            ->groupBy('date')
            ->pluck('orders', 'date')
            ->toArray();

        return $orders;
    }

    /**
     * Show order details.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showOrderDetails(Request $request, Event $event)
    {   
        if ($event->user_id != auth()->user()->id) {
            return redirect('');
        }

        $order_details = Order::select(DB::raw('orders.id, contacts.first_name, contacts.last_name, contacts.email, ticket_groups.name, order_details.quantity, orders.created_at, ticket_groups.price'))
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('ticket_groups', 'ticket_groups.id', '=', 'order_details.ticket_group_id')
                ->join('contacts', 'contacts.id', '=', 'orders.contact_id')
                ->where('orders.event_id', $event->id)
                ->where('orders.order_status', 2)
                ->whereDate('orders.created_at', '>=', $request->start_date)
                ->whereDate('orders.created_at', '<=', $request->end_date)
                ->skip($request->page * $this->orders_limit)->take($this->orders_limit)
                ->get();

        return $order_details;
    }

     /**
     * Show ticket sales.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showTicketSales(Request $request, Event $event)
    {   
        if ($event->user_id != auth()->user()->id) {
            return redirect('');
        }

        $ticket_sales = TicketGroup::select(DB::raw('ticket_groups.name, sum(case when orders.order_status = 2 and date(orders.created_at) between ? and ? then order_details.quantity else 0 end) as tickets_sold, (select count(*) from tickets where tickets.ticket_group_id = ticket_groups.id) as total_tickets, ticket_groups.price'))
                ->setBindings([$request->start_date, $request->end_date])
                ->leftJoin('order_details', 'ticket_groups.id', '=', 'order_details.ticket_group_id')
                ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('ticket_groups.event_id', $event->id)
                ->groupBy('ticket_groups.id')
                ->get();

        $total_tickets_sold = 0;
        $total_revenue      = 0;
        
        foreach ($ticket_sales as $ts) {
            $total_tickets_sold += $ts->tickets_sold;
            $total_revenue      += $ts->tickets_sold * $ts->price;
        }

        $total_cost         = 0.1 * $total_revenue;
        $total_profit       = $total_revenue - $total_cost;

        return array(
            'ticket_sales'      => $ticket_sales,
            'total_tickets_sold' => $total_tickets_sold,
            'total_revenue' => $total_revenue,
            'total_cost'    => $total_cost,
            'total_profit'  => $total_profit
        );
    }
}
