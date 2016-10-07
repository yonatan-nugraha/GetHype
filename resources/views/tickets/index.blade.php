<style>
body {
	background-color: #F1F2F2 !important;
}

.order-tickets {
	margin-top: 30px;
	padding-bottom: 20px !important;
}

.order-header {
	margin-bottom: 30px;
	margin-left: 0 !important;
}

.order-title {
	font-size: 20px;
	font-weight: 600;
	color: #0F3844;
	margin-bottom: 0;
}

.order-content {
	font-size: 14px;
	font-weight: 300;
	color: #0F3844;
}

.order-body {
	padding-bottom: 50px;
}

/**************************************/
/*********** Order Sidebar ************/
/**************************************/

.order-sidebar li {
	border-radius: 0;
	background-color: #fff;
}

.order-sidebar a {
	color: #0F3844;
	background-color: #fff;
	font-size: 13px;
}

.order-sidebar li.active:after {
    content: "";
    display: block;
    height: 3px;
    width: 90%;
    background: #EBD38C;
    margin: 0 auto;
}

.order-sidebar li.active a {
	background-color: #fff !important;
	color: #0F3844 !important;
}

.order-sidebar li.active a:hover {
    background-color: #F1F2F2 !important;
}

.order-sidebar li a:hover {
	color: #0F3844 !important;
}

/**************************************/
/************ Order list **************/
/**************************************/

.order-list {
	max-width: 90%;
	margin-left: 60px;
}

.order-list-row {
	border-left: 4px solid #EBD38C;
	background-color: #fff;
	margin-bottom: 10px;
	cursor: pointer;
}

.order-list-row .thumbnail {
	border-radius: 0;
    border-style: none;
    margin-bottom: 0;
}

.event-header {
	margin-top: 5px;
	margin-bottom: 0;
}

.event-name {
	font-size: 22px;
	font-weight: 400;
}

.event-share {
	font-size: 12px;
	padding-top: 5px;
}

.event-share img {
	max-height: 13px;
	margin-left: 7px;
}

.event-time {
	font-size: 11px;
	font-weight: 400;
}

.order-row-footer {
	padding-top: 15px;
	font-size: 11px;
	margin-bottom: 0;
}

.order-invoice img {
	width: 10px;
}

.ticket-print {
	margin-left: 30px;
}

.ticket-print img {
	width: 13px;
}

#upcoming-events a, #past-events a {
	text-decoration: none;
	color: #0F3844;
}

.order-number {
	margin-left: 20px;
	padding-left: 20px;
	border-left: 1px solid black;
}

.show-hide img {
	width: 11px;
}

.hide-image {
	display: none;
}

/**************************************/
/************ Order Detail ************/
/**************************************/

.order-detail-row {
	margin-bottom: 10px;
	display: none;
}

.order-detail {
	background-color: #fff;
}

.order-detail-title {
	margin-top: 10px;
	border-bottom: 1px solid black;
}

.order-detail-title p {
	margin-bottom: 5px;
	margin-left: 20px;
	font-size: 12px;
	font-weight: 300;
}

.order-detail-body {
	margin: 10px 0;
	padding-left: 5px;
}

.ticket-detail-row {
	margin-bottom: 0;
}

.ticket-quantity {
	font-size: 28px;
	font-weight: 600;
}

.ticket-name {
	font-size: 14px;
	font-weight: 500;
}

.contact-details {
	padding-top: 5px !important;
	padding-left: 40px !important;
	font-size: 11px;
	font-weight: 400;
	border-left: 1px solid black;
}

/**************************************/
/************* Bookmarks **************/
/**************************************/

.bookmarks {
    background-color: #F1F2F2;
    padding-bottom: 30px;
}

.bookmarks .events {
    margin-bottom: 20px;
}

.bookmarks .event-box {
    cursor: pointer;
    padding-bottom: 15px;
}

.bookmarks .event-box a {
    color: #000;
}

.bookmarks .event-box .thumbnail {
    padding: 0;
    border-radius: 0;
    border-style: none;
}

.bookmarks .event-box a:hover {
    text-decoration: none;
}

.bookmarks .event-caption {
    margin: 10px 15px;
    padding-bottom: 10px;
}

.bookmarks .event-caption-head {
    margin-bottom: 10px;
    height: 35px;
}

.bookmarks .event-name {
    color: #0F3844;
    font-size: 15px;
    line-height: 1.3;
}

.bookmarks .event-price {
    color: #0F3844;
    font-size: 12px;
    font-weight: 500;
}

.bookmarks .event-time {
    margin-top: 10px !important;
    font-weight: 100;
    font-size: 12px;
}

.bookmarks .event-tag {
    background-color: #E6E6E6;
    color: #000000;
    font-weight: 200;
    font-size: 10px;
}

.bookmarks .remove-bookmark img {
	width: 10px;
}
</style>

@extends('layouts.app')

@section('content')

<div class="container order-tickets">
	<div class="row order-header">
		<p class="order-title">Find Your Happiness!</p>
		<p class="order-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	</div>
	<div class="row order-body">
		<div class="col-xs-2 order-sidebar">
			<ul class="nav nav-pills nav-stacked">
			  	<li class="active"><a data-toggle="tab" href="#upcoming-events">Upcoming Events</a></li>
			  	<li><a data-toggle="tab" href="#past-events">Past Events</a></li>
			  	<li><a data-toggle="tab" href="#bookmark-events">Bookmark Events</a></li>
			</ul>
		</div>
		<div class="col-xs-10">
			<div class="tab-content">
				<div class="tab-pane fade in active order-list" id="upcoming-events">
					@foreach ($orders as $order)
					@if (Carbon\Carbon::now() <= $order->event->ended_at)
					<div class="row order-list-row" id="{{ $order->id }}">
						<div class="col-xs-2 thumbnail">
							<img src="{{ asset('/images/events/'.$order->event->image()) }}">
						</div>
						<div class="col-xs-10">
					    	<p class="event-header">
					    		<span class="event-name">{{ $order->event->name }}</span>
					    		<span class="pull-right event-share">Share:
					    			<a href="http://www.facebook.com/sharer/sharer.php?u={{ url('/events/'.$order->event->slug) }}" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" target="_blank">
							    		<img class="event-sosmed" src="{{ asset('/images/icons/facebook.png') }}">
							    	</a>

							    	<a href="http://twitter.com/intent/tweet?text={{ urlencode($order->event->name . ' | Gethype' )}}&url={{ url('/events/'.$order->event->slug) }}&hashtags=Gethype&via=Gethype" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=450'); return false;" target="_blank">
							    		<img class="event-sosmed" src="{{ asset('/images/icons/twitter.png') }}">
							    	</a>
					    		</span>
					    	</p>
					    	<p class="event-time">{{ Carbon\Carbon::parse($order->event->started_at)->format('l, M d, Y | g.i A') }}</p>
					    	<p class="order-row-footer">
					    		<a href="{{ url('tickets/'.$order->id.'/invoice') }}" target="_blank">
						    		<span class="order-invoice">
						    			<img src="{{ asset('images/icons/invoice.png') }}"> Invoice
						    		</span>
					    		</a>
					    		<a href="{{ url('tickets/'.$order->id.'/ticket') }}" target="_blank">
						    		<span class="ticket-print"> 
						    			<img src="{{ asset('images/icons/print-ticket.png') }}"> Print Ticket
						    		</span>
					    		</a>
					    		<span class="order-number"> 
					    			Order Number #{{ $order->id }}
					    		</span>
					    		<span class="show-hide pull-right"> 
					    			<span class="show-hide-text" id="show-hide-text-{{ $order->id }}">show </span> 
					    			<img class="show-image" id="show-image-{{ $order->id }}" src="{{ asset('images/icons/show.png') }}">
					    			<img class="hide-image" id="hide-image-{{ $order->id }}" src="{{ asset('images/icons/hide.png') }}">
					    		</span>
					    	</p>
					   </div>
					</div>
					<div class="row order-detail-row" id="order-detail-{{ $order->id }}">
						<div class="col-xs-10 col-xs-offset-2 order-detail">
							<div class="row order-detail-title">
					    		<p>Order Information</p>
					    	</div>
					    	<div class="row order-detail-body">
						    	<div class="col-xs-4">
						    		@foreach ($order->order_details as $order_detail)
						    		<p class="ticket-detail-row">
						    			<span class="ticket-quantity">{{ $order_detail->quantity }}</span>
						    			<span class="ticket-name">{{ $order_detail->ticket_group->name }} 
						    			@if ($order_detail->quantity > 1) tickets @else ticket @endif
						    			</span>
						    		</p>
						    		@endforeach
						    	</div>

						    	<div class="col-xs-8 contact-details">
						    		<p>Name: {{ $order->contact->first_name . ' ' . $order->contact->last_name }}</p>
						    		<p>Email: {{ $order->contact->email }}</p>
						    		<p>Phone: {{ $order->contact->phone }}</p>
						    	</div>
						    </div>
					   </div>
					</div>
					@endif
					@endforeach
				</div>
				<div class="tab-pane fade order-list" id="past-events">
					@foreach ($orders as $order)
					@if (Carbon\Carbon::now() > $order->event->ended_at)
					<div class="row order-list-row" id="{{ $order->id }}">
						<div class="col-xs-2 thumbnail">
							<img src="{{ asset('/images/events/'.$order->event->image()) }}">
						</div>
						<div class="col-xs-10">
					    	<p class="event-header">
					    		<span class="event-name">{{ $order->event->name }}</span>
					    	</p>
					    	<p class="event-time">{{ Carbon\Carbon::parse($order->event->started_at)->format('l, M d, Y | g.i A') }}</p>
					    	<p class="order-row-footer">
					    		<a href="{{ url('tickets/'.$order->id.'/invoice') }}" target="_blank">
						    		<span class="order-invoice">
						    			<img src="{{ asset('images/icons/invoice.png') }}"> Invoice
						    		</span>
					    		</a>
					    		<a href="{{ url('tickets/'.$order->id.'/ticket') }}" target="_blank">
						    		<span class="ticket-print"> 
						    			<img src="{{ asset('images/icons/print-ticket.png') }}"> Print Ticket
						    		</span>
					    		</a>
					    		<span class="order-number"> 
					    			Order Number #{{ $order->id }}
					    		</span>
					    		<span class="show-hide pull-right"> 
					    			<span class="show-hide-text" id="show-hide-text-{{ $order->id }}">show </span> 
					    			<img class="show-image" id="show-image-{{ $order->id }}" src="{{ asset('images/icons/show.png') }}">
					    			<img class="hide-image" id="hide-image-{{ $order->id }}" src="{{ asset('images/icons/hide.png') }}">
					    		</span>
					    	</p>
					   </div>
					</div>
					<div class="row order-detail-row" id="order-detail-{{ $order->id }}">
						<div class="col-xs-10 col-xs-offset-2 order-detail">
							<div class="row order-detail-title">
					    		<p>Order Information</p>
					    	</div>
					    	<div class="row order-detail-body">
						    	<div class="col-xs-4">
						    		@foreach ($order->order_details as $order_detail)
						    		<p class="ticket-detail-row">
						    			<span class="ticket-quantity">{{ $order_detail->quantity }}</span>
						    			<span class="ticket-name">{{ $order_detail->ticket_group->name }} 
						    			@if ($order_detail->quantity > 1) tickets @else ticket @endif
						    			</span>
						    		</p>
						    		@endforeach
						    	</div>

						    	<div class="col-xs-8 contact-details">
						    		<p>Name: {{ $order->contact->first_name . ' ' . $order->contact->last_name }}</p>
						    		<p>Email: {{ $order->contact->email }}</p>
						    		<p>Phone: {{ $order->contact->phone }}</p>
						    	</div>
						    </div>
					   </div>
					</div>
					@endif
					@endforeach
				</div>
				<div class="tab-pane fade order-list bookmarks" id="bookmark-events">
					@foreach ($bookmarks as $bookmark)
	                <div class="col-xs-12 col-md-4 event-box">
	                    <div class="thumbnail">
	                        <a href="{{ url('/events/'.$bookmark->event->slug) }}" target="_blank">
	                            <img class="event-image" src="{{ asset('/images/events/'.$bookmark->event->image()) }}">
	                            <div class="event-caption">
	                                <div class="event-caption-head">
	                                    <span class="event-name">{{ $bookmark->event->name }}</span>
	                                </div>
	                                <span class="event-time clearfix">{{ Carbon\Carbon::parse($bookmark->event->started_at)->format('l, M d, Y | g.i A') }}</span>
	                                <p class="event-price">
	                                </p>
	                                <p>
		                                <span class="label label-default event-tag">{{ $bookmark->event->category->name }}</span>
		                                <span class="label label-default event-tag">{{ $bookmark->event->event_type->name }}</span>
		                                <span class="pull-right remove-bookmark" id="{{ $bookmark->event->id }}">
		                                	<img src="{{ asset('/images/icons/x-button.png') }}">
		                                </span>
	                                </p>
	                            </div>
	                        </a>
	                    </div>      
	                </div>
	                @endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/ticket.js') }}"></script>
@endsection
