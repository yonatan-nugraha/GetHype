<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Event;
use App\Category;
use App\EventType;
use App\Collection;
use App\Journal;

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
    public function index(Request $request)
    {
        $events = Event::select(DB::raw('events.id, events.name, events.category_id, events.event_type_id, events.location, events.started_at, events.ended_at, events.slug, min(ticket_groups.price) as min_price, max(ticket_groups.price) as max_price'))
            ->leftJoin('ticket_groups', 'events.id', '=', 'ticket_groups.event_id')
            ->where('events.status', 1)
            ->where('events.ended_at', '>=', Carbon::now())
            ->groupBy('events.id')
            ->orderBy('events.weight', 'desc');

        return view('home', [
            'events'        => $events->take(8)->get(),
            'collections'   => Collection::where('status', 1)->orderBy('weight', 'desc')->take(4)->get(),
            'journals'      => Journal::where('status', 1)->orderBy('created_at', 'desc')->take(4)->get(),
            'categories'    => Category::where('status', 1)->orderBy('weight', 'desc')->get(),
            'event_types'   => EventType::where('status', 1)->orderBy('weight', 'desc')->get(),
            'locations'     => ['Jakarta', 'Bandung', 'Surabaya', 'Bali'],
        ]);
    }

    /**
     * Display all services form.
     */
    public function services()
    {
        return view('statics/services');
    }

    /**
     * Display contact us form
     */
    public function contactUs()
    {
        return view('statics.contact');
    }

    /**
     * Display about us page.
     */
    public function aboutUs()
    {
        return view('statics/about');
    }

    /**
     * Display email page.
     */
    public function email(Request $request)
    {
        $user = User::find(1);

        $q = $request->q;
        if ($q == 'welcome') {
            return view('emails/welcome');
        }
        else if ($q == 'activate_account') {
            return view('emails/activate_account', [
                'user' => $user,
                'key'   => 'asd'
            ]);
        }
        else if ($q == 'reset_password') {
            return view('emails/reset_password', [
                'user' => $user,
                'token'   => 'asd'
            ]);
        }
        else if ($q == 'checkout_success') {
            return view('emails/checkout_success', [
                'user' => $user,
            ]);
        }
        else if ($q == 'email_blast') {
            return view('emails/email_blast', [
                'user' => $user,
            ]);
        }
        else {
            return view('emails/send');
        }
    }
}
