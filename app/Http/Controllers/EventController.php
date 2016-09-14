<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use App\Http\Requests;

use App\Event;
use App\Category;
use App\EventType;
use App\TicketGroup;
use App\Ticket;
use App\OrderDetail;
use App\Order;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a list of events.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index() {
        return view('admin/event_index', [
        	'page_title'	=> 'Event List',
        	'events'	=> Event::all(),
        ]);
    }

    /**
     * Display a form to create a new event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create() {
        return view('admin/event_create', [
        	'page_title'	=> 'Create Event',
        	'categories' 	=> Category::all(),
        	'event_types' 	=> EventType::all()
        ]);
    }

    /**
	 * Create a new event.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
    public function store(Request $request)
    {
    	$started_at = substr($request->event_time, 0, 19);
    	$ended_at   = substr($request->event_time, 22, 19);

     //    $event_id = $request->user()->events()->create([
     //    	'category_id'  	=> $request->category,
     //    	'event_type_id' => $request->event_type,
	    //     'name'         	=> $request->name,
	    //     'description'  	=> $request->description,
	    //     'location'		=> $request->location,
	    //     'started_at' 	=> $started_at,
	    //     'ended_at'		=> $ended_at,
	    //     'status'		=> 0,
     //        'slug'         	=> str_slug($request->name, "-")
	    // ])->id;

        $event_id = 1;

        $ticket_group_id = TicketGroup::create([
            'event_id'      => $event_id,
            'name'          => $request->ticket_name,
            'price'         => $request->ticket_price,
            'started_at'    => $started_at,
            'ended_at'      => $ended_at,
        ])->id;

        for ($i = 0; $i < $request->ticket_quantity; $i++) {
            Ticket::create([
                'ticket_group_id' => $ticket_group_id,
                'code'      => sprintf("%s", mt_rand(1000000, 9999999)),
                'status'    => 1,
            ]);
        }

	    return redirect('admin/events');
    }

    /**
     * Display a form to edit an event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit(Request $request, Event $event) {
        return view('admin/event_edit', [
            'page_title'    => 'Edit Event',
            'event'         => $event,
            'categories'    => Category::all(),
            'event_types'   => EventType::all()
        ]);
    }

    /**
     * Edit an event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, Event $event)
    {
        $started_at = substr($request->event_time, 0, 19);
        $ended_at   = substr($request->event_time, 22, 19);

        $event->update([
            'category_id'   => $request->category,
            'event_type_id' => $request->event_type,
            'name'           => $request->name,
            'description'    => $request->description,
            'location'       => $request->location,
            'started_at'     => $started_at,
            'ended_at'       => $ended_at,
            'slug'           => str_slug($request->name, "-")
        ]);

        return redirect('admin/events');
    }

    /**
     * Edit event's status.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStatus(Request $request, Event $event)
    {
        $event->status   = $request->status;
        
        $event->save();

        return redirect('admin/events');
    }


    /**
     * Display an event
     *
     * @param  Request  $request
     * @return Response
     */
    public function show(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->first();

        return view('events/show', [
        	'event' => $event,
            'guests' => ['Joko Widodo', 'Basuki Tjahaja Purnama', 'Mark Zuckerberg', 'Larry Page']
        ]);
    }

    /**
     * Book tickets.
     *
     * @param  Request  $request
     * @return Response
     */
    public function bookTicket(Request $request, Event $event)
    {
        $order_details = collect();
        $ticket_ids = collect();
        $amount = 0;

        foreach ($event->ticket_groups as $ticket_group) {
            $quantity = $request->input('ticket_quantity_'.$ticket_group->id);

            if ($quantity > 0) {
                $tickets = Ticket::where('ticket_group_id', $ticket_group->id)
                    ->where('status', 1)
                    ->take($quantity)
                    ->lockForUpdate()
                    ->get();

                if (count($tickets) != $quantity) {
                    return;
                }

                foreach ($tickets as $ticket) {
                    $ticket_ids[] = $ticket->id;
                }

                $amount += $quantity * $ticket_group->price;

                $order_detail = new OrderDetail;
                $order_detail->ticket_group = $ticket_group;
                $order_detail->quantity = $quantity;
                $order_details[] = $order_detail;
            }
        }

        Ticket::whereIn('id', $ticket_ids)
            ->update(['status' => 2]);

        Redis::set('order_details:'.$request->user()->id, json_encode($order_details));
        Redis::set('ticket_ids:'.$request->user()->id, json_encode($ticket_ids));
        Redis::set('amount:'.$request->user()->id, json_encode($amount));

        return redirect('checkout');
    }
}
