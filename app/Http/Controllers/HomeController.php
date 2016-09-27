<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Category;
use App\EventType;

use DB, Carbon\Carbon;

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
        ->where('events.status', 1)
        ->where('events.started_at', '<=', Carbon::now())
        ->where('events.ended_at', '>=', Carbon::now())
        ->groupBy('events.id')
        ->orderBy('events.started_at', 'desc');

        return view('home', [
            'events'        => $events->take(8)->get(),
            'collections'   => Event::orderBy('id')->take(4)->get(),
            'journals'      => Event::orderBy('id')->take(4)->get(),
            'categories'    => Category::all(),
            'event_types'   => EventType::all(),
            'locations'     => ['Jakarta', 'Bandung', 'Surabaya', 'Bali'],
        ]);
    }

    /**
     * Display all services form.
     */
    public function service()
    {
        return view('statics/service');
    }
}
