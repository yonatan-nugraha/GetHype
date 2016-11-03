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
use App\Bookmark;
use App\PageView;
use App\Collection;
use App\EventCollection;
use App\Guest;
use App\Banner;

use DB, Carbon\Carbon, Cache;

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
     * Display an event detail
     *
     * @param  Request  $request
     * @return Response
     */
    public function showDetail(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->first();
        if (count($event) == 0) {
            return redirect('');
        }

        $cookie_name   = 'page_views:' . $event->id;
        $cookie_value  = $request->cookie($cookie_name);

        $response = response()->view('events/detail', [
            'event' => $event,
            'guests' => $event->guests->where('status', 1),
        ]);

        if ($cookie_value == null) {
            $user_id = auth()->check() ? auth()->id() : 0;

            PageView::create([
                'user_id'   => $user_id,
                'event_id'  => $event->id
            ]);

            $response->cookie($cookie_name, md5($event->id), 300);
        } 

        return $response;
    }

    /**
     * Book tickets.
     *
     * @param  Request  $request
     * @return Response
     */
    public function bookTicket(Request $request, Event $event)
    {
        if (auth()->guest()) {
            session()->put('url.intended', '/events/'.$event->slug);

            return array(
                'success' => 0,
                'login'   => 0
            );
        }

        $order_details  = array();
        $ticket_ids     = array();
        $order_amount   = 0;
        $total_quantity = 0;

        foreach ($event->ticket_groups_available as $ticket_group) {
            $quantity = $request->input('ticket_quantity_'.$ticket_group->id);
            $total_quantity += $quantity;

            if ($quantity > 0) {
                $tickets = Ticket::where('ticket_group_id', $ticket_group->id)
                    ->where('status', 1)
                    ->take($quantity)
                    ->lockForUpdate()
                    ->get();

                if (count($tickets) != $quantity) {
                    return array(
                        'success'   => 0,
                        'message'   => 'Cannot book ticket at the moment, please try again in a while :)'
                    );
                }

                foreach ($tickets as $ticket) {
                    $ticket_ids[] = $ticket->id;
                }

                $order_amount               += $quantity * $ticket_group->price;

                $order_detail               = new OrderDetail;
                $order_detail->ticket_group = $ticket_group;
                $order_detail->quantity     = $quantity;
                $order_details[]            = $order_detail;
            }
        }

        if ($order_details == null) {
            return array(
                'success'   => 0,
                'message'   => 'Please select the quantity of the ticket that you would like to buy.'
            );
        }

        Ticket::where('status', 2)
            ->where('booked_by', auth()->id())
            ->update([
                'status' => 1,
                'booked_by' => null,
            ]);

        Ticket::whereIn('id', $ticket_ids)
            ->update([
                'status' => 2,
                'booked_by' => auth()->id(),
            ]);

        $order = array(
            'order_details' => $order_details,
            'ticket_ids'    => $ticket_ids,
            'event'         => $event,
            'order_amount'  => $order_amount,
            'total_quantity' => $total_quantity
        );

        Redis::set('order:'.auth()->id(), json_encode($order));
        Redis::expire('order:'.auth()->id(), 90*60);

        return array(
            'success'   => 1,
            'message'   => 'Please do checkout.'
        );
    }

    /**
     * Search for events.
     *
     * @param  Request  $request
     * @return Response
     */
    public function search(Request $request)
    {
        $category   = $request->category;
        $event_type = $request->event_type;
        $location   = $request->location;
        $date       = $request->date;
        $price      = $request->price;

        $events = Event::select(DB::raw('events.id, events.name, events.category_id, events.event_type_id, events.location, events.started_at, events.ended_at, events.slug, min(ticket_groups.price) as min_price, max(ticket_groups.price) as max_price'))
                    ->leftJoin('ticket_groups', 'events.id', '=', 'ticket_groups.event_id')
                    ->where('events.status', 1)
                    ->where('events.started_at', '<=', Carbon::now())
                    ->where('events.ended_at', '>=', Carbon::now())
                    ->groupBy('events.id')
                    ->orderBy('events.weight', 'desc');

        if ($category && $category != 'all') {
            $events->where('category_id', $category);
        }

        if ($event_type && $event_type != 'all') {
            $events->where('event_type_id', $event_type);
        }

        if ($location && $location != 'all') {
            $events->where('location', 'like', '%'.$location.'%');
        }

        if ($date && $date != '') {
            $events->whereDate('events.started_at', '<=', $date);
            $events->whereDate('events.ended_at', '>=', $date);
        }

        if ($price && $price != 'all') {
            if ($price == 'free') {
                $events->havingRaw('sum(ticket_groups.price) = 0 or sum(ticket_groups.price) is null');
            } 
            else if ($price == 'paid') {
                $events->havingRaw('sum(ticket_groups.price) > 0');
            }
        }

        $events = $events->paginate(2);
        $events->setPath('search?category='.$category.'&event_type='.$event_type.'&location='.$location.'&date='.$date.'&price='.$price);

        $carousel_banners = Cache::remember('carousel_banners_search', 24*60, function() {
            return Banner::where('status', 1)
                ->where('type', 3)
                ->where('started_at', '<=', Carbon::now())
                ->where('ended_at', '>=', Carbon::now())
                ->orderBy('weight', 'desc')
                ->take(5)
                ->get();
        });

        return view('events/search', [
            'events'        => $events,
            'categories'    => Category::all(),
            'event_types'   => EventType::all(),
            'locations'     => ['Jakarta', 'Bandung', 'Surabaya', 'Bali'],
            'carousel_banners' => $carousel_banners
        ]);
    }

    /**
     * Add bookmark.
     *
     * @param  Request  $request
     * @return Response
     */
    public function addBookmark(Request $request, Event $event)
    {   
        if (auth()->guest()) {
            session()->put('url.intended', '/events/'.$event->slug);

            return array(
                'success' => 0,
                'login'   => 0
            );
        }

        $bookmark   = Bookmark::where('event_id', $event->id)
                        ->where('user_id', auth()->id())
                        ->get();

        if (count($event) > 0 && count($bookmark) == 0) {
            Bookmark::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id
            ]);

            return array(
                'success' => 1,
                'message' => 'This event has been succesfully added to your bookmark list'
            );
        }

        return array(
            'success' => 0,
            'message' => 'This event is already on your bookmark list'
        );
    }

    /**
     * Remove bookmark.
     *
     * @param  Request  $request
     * @return Response
     */
    public function removeBookmark(Request $request, Event $event)
    {   
        if (auth()->guest()) {
            session()->put('url.intended', '/events/'.$event->slug);

            return array(
                'success' => 0,
                'login'   => 0
            );
        }
        
        $bookmark   = Bookmark::where('event_id', $event->id)
                        ->where('user_id', auth()->id())
                        ->get();

        if (count($event) > 0 && count($bookmark) > 0) {
            Bookmark::where('event_id', $event->id)
                        ->where('user_id', auth()->id())
                        ->delete();

            return array(
                'success' => 1,
                'message' => 'This event has been succesfully added to your bookmark list'
            );
        }

        return array(
            'success' => 0,
            'message' => 'This event has been succesfully added to your bookmark list'
        );
    }

    /**
     * Display an event collection detail
     *
     * @param  Request  $request
     * @return Response
     */
    public function showCollectionDetail(Request $request, $slug)
    {
        $collection = Collection::where('slug', $slug)->first();
        if (count($collection) == 0) {
            return redirect('');
        }

        return view('events/collection', [
            'collection' => $collection,
        ]);
    }
}
