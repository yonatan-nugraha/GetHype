<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Event;
use App\Category;
use App\EventType;
use App\TicketGroup;
use App\Ticket;
use App\Collection;
use App\EventCollection;
use App\Journal;
use App\Order;
use App\OrderDetail;
use App\Guest;

use Carbon\Carbon;

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
    public function index(Request $request)
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
     * Display a list of users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showUserList(Request $request)
    {
        return view('admin/user_index', [
            'page_title'    => 'User List',
            'users'         => User::all()
        ]);
    }

    /**
     * Display a form to edit a user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function editUser(Request $request, User $user) 
    {
        return view('admin/user_edit', [
            'page_title'   => 'Edit User',
            'user'         => $user,
        ]);
    }

    /**
     * Edit a user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateUser(Request $request, User $user)
    {
        $user->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'gender'      => $request->gender,
            'birthdate'    => $request->birthdate,
        ]);

        return redirect('admin/users');
    }

    /**
     * Edit user's status.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStatusUser(Request $request, User $user)
    {
        $status = $request->status ? 1 : 0;

        $user->update([
            'status' => $status,
        ]);

        return redirect('admin/users');
    }

    /**
     * Display a list of emails by prefix.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getEmailList(Request $request)
    {
        return User::where('email', 'like', $request->email.'%')
            ->pluck('email')
            ->toArray();
    }

    /**
     * Display a list of events.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showEventList(Request $request)
    {
        $events = Event::orderBy('created_at', 'asc');

        $q = $request->q;
        if ($q != '') {
            $events->where('name', 'like', '%'.$q.'%');
        }

        $events = $events->paginate(10);

        return view('admin/event_index', [
            'page_title'    => 'Event List',
            'events'        => $events,
            'collections'   => Collection::all()
        ]);
    }

    /**
     * Display a form to create a new event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createEvent(Request $request)
    {
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
    public function editEvent(Request $request, Event $event) 
    {
        return view('admin/event_edit', [
            'page_title'    => 'Edit Event',
            'event'         => $event,
            'categories'    => Category::all(),
            'event_types'   => EventType::all()
        ]);
    }

    /**
     * Create a new event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeEvent(Request $request)
    {
        $started_at = substr($request->event_time, 0, 19);
        $ended_at   = substr($request->event_time, 22, 19);

        $event_id = $request->user()->events()->create([
            'category_id'   => $request->category,
            'event_type_id' => $request->event_type,
            'name'          => $request->name,
            'description'   => $request->description,
            'location'      => $request->location,
            'started_at'    => $started_at,
            'ended_at'      => $ended_at,
            'subject_discussion' => $request->subject_discussion,
            'video_url'     => $request->video_url,
            'status'        => 0,
            'slug'          => str_slug($request->name, '-') . '-' . sprintf("%s", mt_rand(10000, 99999)),
        ])->id;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $request->image->move(public_path('/images/events'), md5('event-'.$event_id).'.jpg');
        }

        if ($request->hasFile('banner') && $request->banner->isValid()) {
            $request->banner->move(public_path('/images/events'), md5('event-banner-'.$event_id).'.jpg');
        }

        for ($i = 1; $i <= $request->ticket_group_quantity; $i++) {
            $ticket_group_id = TicketGroup::create([
                'event_id'      => $event_id,
                'name'          => $request['ticket_name_'.$i],
                'description'   => '',
                'price'         => $request['ticket_price_'.$i],
                'status'        => 1,
                'started_at'    => Carbon::now(),
                'ended_at'      => $ended_at,
            ])->id;

            for ($j = 0; $j < $request['ticket_quantity_'.$i]; $j++) {
                Ticket::create([
                    'ticket_group_id' => $ticket_group_id,
                    'code'      => sprintf('8%s-%s-%s-%s', mt_rand(100, 999), mt_rand(1000, 9999), mt_rand(1000, 9999), mt_rand(1000, 9999)),
                    'status'    => 1,
                ]);
            }
        }

        for ($i = 1; $i <= $request->guest_quantity; $i++) {
            $guest_id = Guest::create([
                'event_id'      => $event_id,
                'name'          => ucwords(trim($request['guest_name_'.$i])),
                'title'         => trim($request['guest_title_'.$i]),
                'description'   => '',
                'status'        => 1,
            ])->id;

            if ($request->hasFile('guest_image_'.$i) && $request->file('guest_image_'.$i)->isValid()) {
                $request->file('guest_image_'.$i)->move(public_path('/images/guests'), md5('guest-'.$guest_id).'.jpg');
            }
        }

        return redirect('admin/events');
    }

    /**
     * Edit an event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateEvent(Request $request, Event $event)
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
            'subject_discussion' => $request->subject_discussion,
            'video_url'     => $request->video_url,
        ]);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $request->image->move(public_path('/images/events'), md5('event-'.$event->id).'.jpg');
        }

        if ($request->hasFile('banner') && $request->banner->isValid()) {
            $request->banner->move(public_path('/images/events'), md5('event-banner-'.$event->id).'.jpg');
        }

        foreach ($event->ticket_groups as $ticket_group) {
            $ticket_group->update([
                'name'          => trim($request['ticket_name_update_'.$ticket_group->id]),
                'description'   => '',
                'status'        => $request['ticket_status_update_'.$ticket_group->id] ? 1 : 0,
                'started_at'    => substr($request['ticket_time_update_'.$ticket_group->id], 0, 19),
                'ended_at'      => substr($request['ticket_time_update_'.$ticket_group->id], 22, 19),
            ]);

            $ticket_qty = $request['ticket_qty_'.$ticket_group->id];
            if ($ticket_qty > 0) {
                for ($i = 0; $i < $ticket_qty; $i++) {
                    Ticket::create([
                        'ticket_group_id' => $ticket_group->id,
                        'code'      => sprintf('8%s-%s-%s-%s', mt_rand(100, 999), mt_rand(1000, 9999), mt_rand(1000, 9999), mt_rand(1000, 9999)),
                        'status'    => 1,
                    ]);
                }
            }
        }

        for ($i = 1; $i <= $request->ticket_group_quantity; $i++) {
            $ticket_group_id = TicketGroup::create([
                'event_id'      => $event->id,
                'name'          => $request['ticket_name_'.$i],
                'description'   => '',
                'price'         => $request['ticket_price_'.$i],
                'status'        => 1,
                'started_at'    => Carbon::now(),
                'ended_at'      => $ended_at,
            ])->id;

            for ($j = 0; $j < $request['ticket_quantity_'.$i]; $j++) {
                Ticket::create([
                    'ticket_group_id' => $ticket_group_id,
                    'code'      => sprintf('8%s-%s-%s-%s', mt_rand(100, 999), mt_rand(1000, 9999), mt_rand(1000, 9999), mt_rand(1000, 9999)),
                    'status'    => 1,
                ]);
            }
        }

        foreach ($event->guests as $guest) {
            $guest->update([
                'name'          => ucwords(trim($request['guest_name_update_'.$guest->id])),
                'title'         => trim($request['guest_title_update_'.$guest->id]),
                'description'   => $request['guest_description_update_'.$guest->id],
                'status'        => $request['guest_status_update_'.$guest->id] ? 1 : 0,
            ]);

            if ($request->hasFile('guest_image_update_'.$guest->id) && $request->file('guest_image_update_'.$guest->id)->isValid()) {
                $request->file('guest_image_update_'.$guest->id)->move(public_path('/images/guests'), md5('guest-'.$guest->id).'.jpg');
            }
        }

        for ($i = 1; $i <= $request->guest_quantity; $i++) {
            $guest_id = Guest::create([
                'event_id'      => $event->id,
                'name'          => ucwords(trim($request['guest_name_'.$i])),
                'title'         => trim($request['guest_title_'.$i]),
                'description'   => '',
                'status'        => 1,
            ])->id;

            if ($request->hasFile('guest_image_'.$i) && $request->file('guest_image_'.$i)->isValid()) {
                $request->file('guest_image_'.$i)->move(public_path('/images/guests'), md5('guest-'.$guest_id).'.jpg');
            }
        }

        return redirect('admin/events');
    }

    /**
     * Edit event's status.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStatusEvent(Request $request, Event $event)
    {
        $status = $request->status ? 1 : 0;

        $event->update([
            'status' => $status,
        ]);

        return redirect('admin/events');
    }

    /**
     * Edit event's user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateUserEvent(Request $request, Event $event)
    {
        $email = trim($request->email);
        $user = User::where('email', $email)->first();

        if (count($user) == 0) {
            return array(
                'success' => 0,
                'message' => 'Email doesn\'t exist'
            );
        }

        $event->update([
            'user_id' => $user->id,
        ]);

        return array(
            'success' => 1,
            'message' => 'Success'
        );
    }

    /**
     * Display a list of collections.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showCollectionList(Request $request) 
    {
        $collections = Collection::orderBy('created_at', 'asc');

        $q = $request->q;
        if ($q != '') {
            $collections->where('name', 'like', '%'.$q.'%');
        }

        $collections = $collections->paginate(10);

        return view('admin/collection_index', [
            'page_title'    => 'Collection List',
            'collections'   => $collections,
        ]);
    }

    /**
     * Display a form to create a new collection.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createCollection(Request $request)
    {
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
    public function editCollection(Request $request, Collection $collection) 
    {
        return view('admin/collection_edit', [
            'page_title'    => 'Edit Collection',
            'collection'    => $collection
        ]);
    }

    /**
     * Create a new collection.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeCollection(Request $request)
    {
        $collection_id = Collection::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'status'        => 0,
            'slug'          => str_slug($request->name, '-') . '-' . sprintf("%s", mt_rand(10000, 99999)),
        ])->id;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $request->image->move(public_path('/images/collections'), md5('collection-'.$collection_id).'.jpg');
        }

        return redirect('admin/collections');
    }

    /**
     * Edit a collection.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateCollection(Request $request, Collection $collection)
    {
        $collection->update([
            'name'           => $request->name,
            'description'    => $request->description,
        ]);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $request->image->move(public_path('/images/collections'), md5('collection-'.$collection->id).'.jpg');
        }

        return redirect('admin/collections');
    }

    /**
     * Edit collection's status.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStatusCollection(Request $request, Collection $collection)
    {
        $status = $request->status ? 1 : 0;

        $collection->update([
            'status' => $status,
        ]);

        return redirect('admin/collections');
    }

    /**
     * Add an event to the collection.
     *
     * @param  Request  $request
     * @return Response
     */
    public function addEventCollection(Request $request)
    {
        $event_collection = EventCollection::where('collection_id', $request->collection_id)
            ->where('event_id', $request->event_id)
            ->get();

        if (count($event_collection) == 0) {
            EventCollection::create([
                'collection_id' => $request->collection_id,
                'event_id' => $request->event_id,
            ]);
        }

        return redirect('admin/collections');
    }

    /**
     * Display a list of journals.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showJournalList(Request $request) 
    {
        $journals = Journal::orderBy('created_at', 'asc');

        $q = $request->q;
        if ($q != '') {
            $journals->where('title', 'like', '%'.$q.'%');
        }

        $journals = $journals->paginate(10);

        return view('admin/journal_index', [
            'page_title'    => 'Journal List',
            'journals'      => $journals,
        ]);
    }

    /**
     * Display a form to create a new journal.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createJournal(Request $request)
    {
        return view('admin/journal_create', [
            'page_title'    => 'Create Journal',
        ]);
    }

    /**
     * Display a form to edit an event.
     *
     * @param  Request  $request
     * @return Response
     */
    public function editJournal(Request $request, Journal $journal) 
    {
        return view('admin/journal_edit', [
            'page_title'    => 'Edit Journal',
            'journal'         => $journal,
        ]);
    }

    /**
     * Create a new journal.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeJournal(Request $request)
    {
        $journal_id = Journal::create([
            'title'     => $request->title,
            'content'   => $request->content,
            'tag'       => $request->tag,
            'slug'      => str_slug($request->title, '-') . '-' . sprintf("%s", mt_rand(10000, 99999)),
            'status'    => 0
        ])->id;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $request->image->move(public_path('/images/journals'), md5('journal-'.$journal_id).'.jpg');
        }

        return redirect('admin/journals');
    }

    /**
     * Edit a journal.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateJournal(Request $request, Journal $journal)
    {
        $journal->update([
            'title'     => $request->title,
            'content'   => $request->content,
            'tag'       => $request->tag,
        ]);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $request->image->move(public_path('/images/journals'), md5('journal-'.$journal->id).'.jpg');
        }

        return redirect('admin/journals');
    }

    /**
     * Edit journal's status.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStatusJournal(Request $request, Journal $journal)
    {
        $status = $request->status ? 1 : 0;

        $journal->update([
            'status' => $status,
        ]);

        return redirect('admin/journals');
    }

    /**
     * Display a list of orders.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showOrderList(Request $request)
    {
        $orders = Order::orderBy('created_at', 'asc');

        $orders = $orders->paginate(10);

        return view('admin/order_index', [
            'page_title'    => 'Order List',
            'orders'        => $orders,
        ]);
    }

}