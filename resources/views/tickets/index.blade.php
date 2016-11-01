@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/ticket-index.css') }}">
@endsection

@section('content')
<div class="container order-tickets">
	<div class="row">
		<div class="col-xs-12 col-sm-2">
			<div class="order-sidebar">
				<ul class="nav nav-stacked nav-pills">
				  	<li class="active"><a data-toggle="tab" href="#upcoming-events">Upcoming Events</a></li>
				  	<li><a data-toggle="tab" href="#past-events">Past Events</a></li>
				  	<li><a data-toggle="tab" href="#bookmark-events">Bookmark Events</a></li>
				</ul>
			</div>
		</div>
		<div class="col-xs-12 col-sm-10">
			<div class="tab-content">
				<div class="tab-pane fade in active order-list" id="upcoming-events">
					@foreach ($orders as $order)
					@if (Carbon\Carbon::now() <= $order->event->ended_at)
					<div class="order-list-row" id="{{ $order->id }}">
						<div class="col-xs-12 col-sm-3 col-md-2 thumbnail">
							<img src="{{ asset('/images/events/'.$order->event->image()) }}">
						</div>
						<div class="col-xs-12 col-sm-9 col-md-10">
					    	<p class="event-header">
					    		<span class="event-name">{{ $order->event->name }}</span>
					    		<span class="event-share">Share:
					    			<a href="http://www.facebook.com/sharer/sharer.php?u={{ url('/events/'.$order->event->slug) }}" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" target="_blank">
							    		<img class="event-sosmed" src="{{ asset('/images/icons/facebook.png') }}">
							    	</a>

							    	<a href="http://twitter.com/intent/tweet?text={{ urlencode($order->event->name . ' | Gethype' )}}&url={{ url('/events/'.$order->event->slug) }}&hashtags=Gethype&via=gethype.id" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=450'); return false;" target="_blank">
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
					   <div class="clearfix"></div>
					</div>
					
					<div class="order-detail-row" id="order-detail-{{ $order->id }}">
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
						    		<p>Name: {{ $order->first_name . ' ' . $order->last_name }}</p>
						    		<p>Email: {{ $order->email }}</p>
						    		<p>Phone: {{ $order->phone }}</p>
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
