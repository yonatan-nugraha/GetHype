<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Category;
use App\EventType;

use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $events = Event::select(DB::raw('events.id, events.name, events.category_id, events.event_type_id, events.location, events.started_at, events.ended_at, events.slug, min(ticket_groups.price) as min_price, max(ticket_groups.price) as max_price'))
        ->leftJoin('ticket_groups', 'events.id', '=', 'ticket_groups.event_id')
        ->whereIn('status', [1,2])
        ->groupBy('events.id');

        return view('home', [
            'events'        => $events->orderByRaw('rand()')->take(8)->get(),
            'collections'   => Event::orderBy('id')->take(4)->get(),
            'journals'      => Event::orderBy('id')->take(4)->get(),
            'categories'    => Category::all(),
            'event_types'   => EventType::all(),
            'locations'     => ['Jakarta', 'Bandung', 'Surabaya', 'Bali'],
        ]);
    }
}
