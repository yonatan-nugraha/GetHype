<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Event;
use App\Category;
use App\EventType;
use App\Collection;
use App\Journal;
use App\Banner;
use App\Order;

use DB, Carbon\Carbon, Cache, Mail;

use App\Mail\CheckoutSuccess;

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
        $events = Cache::remember('events', 24*60, function() {
            return Event::select(DB::raw('events.id, events.name, events.category_id, events.event_type_id, events.location, events.started_at, events.ended_at, events.slug, min(ticket_groups.price) as min_price, max(ticket_groups.price) as max_price'))
                ->leftJoin('ticket_groups', 'events.id', '=', 'ticket_groups.event_id')
                ->where('events.status', 1)
                ->where('events.ended_at', '>=', Carbon::now())
                ->groupBy('events.id')
                ->orderBy('events.weight', 'desc')
                ->take(8)
                ->get();
        });

        $collections = Cache::remember('collections', 24*60, function() {
            return Collection::where('status', 1)
                ->orderBy('weight', 'desc')
                ->take(4)
                ->get();
        });

        $journals = Cache::remember('journals', 24*60, function() {
            return Journal::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        });

        $categories = Cache::remember('categories', 24*60, function() {
            return Category::where('status', 1)
                ->orderBy('weight', 'desc')
                ->get();
        });

        $event_types = Cache::remember('event_types', 24*60, function() {
            return EventType::where('status', 1)
                ->orderBy('weight', 'desc')
                ->get();
        });

        $carousel_banners = Cache::remember('carousel_banners', 24*60, function() {
            return Banner::where('status', 1)
                ->where('type', 1)
                ->where('started_at', '<=', Carbon::now())
                ->where('ended_at', '>=', Carbon::now())
                ->orderBy('weight', 'desc')
                ->take(5)
                ->get();
        });

        $small_banners = Cache::remember('small_banners', 24*60, function() {
            return Banner::where('status', 1)
                ->where('type', 2)
                ->where('started_at', '<=', Carbon::now())
                ->where('ended_at', '>=', Carbon::now())
                ->orderBy('weight', 'desc')
                ->take(3)
                ->get();
        });

        return view('home', [
            'events'        => $events,
            'collections'   => $collections,
            'journals'      => $journals,
            'categories'    => $categories,
            'event_types'   => $event_types,
            'carousel_banners' => $carousel_banners,
            'small_banners' => $small_banners,
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
     * Display help page.
     */
    public function help()
    {
        return view('statics/help');
    }

    /**
     * Display email page.
     */
    public function email(Request $request)
    {
        $user = User::find(1);
        $order = Order::find(21);

        $q = $request->q;
        if ($q == 'welcome') {
            return view('emails/welcome', [
                'user' => $user,
            ]);
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
                'order'  => $order,
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
