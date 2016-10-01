<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Event;
use App\Category;
use App\EventType;
use App\Collection;

class AdminController extends Controller {

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
     * Display main dashboard.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index() 
    {
        $data['tasks'] = [
            [
                'name' => 'Design New Dashboard',
                'progress' => '87',
                'color' => 'danger'
            ],
        ];
        return view('admin/test')->with($data);
    }

    /**
     * Display a list of events.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showEventList() {
        return view('admin/event_index', [
            'page_title'    => 'Event List',
            'events'        => Event::all(),
            'collections'   => Collection::all()
        ]);
    }

    /**
     * Display a form to create a new event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createEvent() {
        return view('admin/event_create', [
            'page_title'    => 'Create Event',
            'categories'    => Category::all(),
            'event_types'   => EventType::all()
        ]);
    }

    /**
     * Display a form to edit an event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function editEvent(Request $request, Event $event) {
        return view('admin/event_edit', [
            'page_title'    => 'Edit Event',
            'event'         => $event,
            'categories'    => Category::all(),
            'event_types'   => EventType::all()
        ]);
    }

    /**
     * Display a list of collections.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showCollectionList() {
        return view('admin/collection_index', [
            'page_title'    => 'Collection List',
            'collections'   => Collection::all()
        ]);
    }

    /**
     * Display a form to create a new collection.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createCollection() {
        return view('admin/collection_create', [
            'page_title'    => 'Create Collection',
        ]);
    }

    /**
     * Display a form to edit a collection.
     *
     * @param  Request  $request
     * @return Response
     */
    public function editCollection(Request $request, Collection $collection) {
        return view('admin/collection_edit', [
            'page_title'    => 'Edit Collection',
            'collection'    => $collection
        ]);
    }

}