<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Category;
use App\EventType;

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
        return view('home', [
            'events'        => Event::orderByRaw('rand()')->take(8)->get(),
            'collections'   => Event::orderBy('id')->take(4)->get(),
            'journals'      => Event::orderBy('id')->take(4)->get(),
            'categories'    => Category::all(),
            'event_types'   => EventType::all(),
            'locations'     => ['Jakarta', 'Bandung', 'Surabaya', 'Bali'],
        ]);
    }
}
