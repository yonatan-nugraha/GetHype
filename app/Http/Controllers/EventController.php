<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Event;
use App\Category;
use App\EventType;

class EventController extends Controller
{
    public function index() {
        return view('admin/event_index', [
        	'page_title'	=> 'Event List',
        	'events'	=> Event::all(),
        ]);
    }

    public function create() {
        return view('admin/event_create', [
        	'page_title'	=> 'Create Event',
        	'categories' 	=> Category::all(),
        	'event_types' 	=> EventType::all()
        ]);
    }

    /**
	 * Create a new product.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
    public function store(Request $request)
    {
    	$start_time = substr($request->event_time, 0, 19);
    	$end_time = substr($request->event_time, 22, 19);

        $request->user()->events()->create([
        	'category_id'  	=> $request->category,
        	'event_type_id' => $request->event_type,
	        'name'         	=> $request->name,
	        'description'  	=> $request->description,
	        'location'		=> $request->location,
	        'start_time' 	=> $start_time,
	        'end_time'		=> $end_time,
	        'status'		=> 0,
            'slug'         	=> str_slug($request->name, "-")
	    ]);

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

        if ($request->user() && $request->user()->id == $event->user_id) {
            $event->disabled = 'disabled';
        }

        return view('events/show', [
        	'event' => $event
        ]);
    }
}
