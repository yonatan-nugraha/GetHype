@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/myevent-list.css') }}">
@endsection

@section('content')
<div class="container myevents">
	<div class="row">
		<div class="col-xs-12 col-sm-2">
			<div class="myevents-sidebar">
				<ul class="nav nav-pills nav-stacked">
				  	<li class="active"><a data-toggle="tab" href="#upcoming-events">Upcoming Events</a></li>
				  	<li><a data-toggle="tab" href="#past-events">Past Events</a></li>
				</ul>
			</div>
		</div>
		<div class="col-xs-12 col-sm-10">
			<div class="tab-content">
				<div class="tab-pane fade in active myevents-list" id="upcoming-events">
					@foreach ($events as $event)
					@if (Carbon\Carbon::now() <= $event->ended_at)
					<div class="myevents-list-row" id="{{ $event->id }}">
						<div class="col-xs-12 col-sm-3 col-md-2 thumbnail">
							<img src="{{ asset('/images/events/'.$event->image()) }}">
						</div>
						<div class="col-xs-12 col-sm-9 col-md-10">
					    	<p class="event-header">
					    		<span class="event-name">{{ $event->name }}</span>
					    		<span class="event-share">
					    			<a href="{{ url('myevents/'.$event->id.'/register') }}">
						    			<button type="button" class="btn btn-default">
										  	<img src="{{ url('images/icons/arrow-full.png') }}" alt="" width="18">
										</button>
									</a>
					    			<a href="{{ url('myevents/'.$event->id.'/statistic') }}">
										<button type="button" class="btn btn-default">
										  	<img src="{{ url('images/icons/chart.png') }}" alt="" width="18">
										</button>
									</a>
						    		<a href="{{ url('events/'.$event->slug) }}">
						    			<button type="button" class="btn btn-default">
										  	<img src="{{ url('images/icons/checklist.png') }}" alt="" width="18">
										</button>
									</a>
									<div class="clearfix"></div>
					    		</span>
					    	</p>
					    	<p class="event-time">{{ Carbon\Carbon::parse($event->started_at)->format('l, M d, Y | g.i A') }}</p>
					    	<p class="event-location">{{ $event->location }}</p>
					   </div>
					   <div class="clearfix"></div>
					</div>
					@endif
					@endforeach
				</div>
				<div class="tab-pane fade order-list" id="past-events">
					@foreach ($events as $event)
					@if (Carbon\Carbon::now() > $event->ended_at)
					<div class="row myevents-list-row" id="{{ $event->id }}">
						<div class="col-xs-2 thumbnail">
							<img src="{{ asset('/images/events/'.$event->image()) }}">
						</div>
						<div class="col-xs-10">
					    	<p class="event-header">
					    		<span class="event-name">{{ $event->name }}</span>
					    		<span class="event-share">
					    			<a href="{{ url('myevents/'.$event->id.'/register') }}">
						    			<button type="button" class="btn btn-default">
										  	<img src="{{ url('images/icons/arrow-full.png') }}" alt="" width="18">
										</button>
									</a>
					    			<a href="{{ url('myevents/'.$event->id.'/statistic') }}">
										<button type="button" class="btn btn-default">
										  	<img src="{{ url('images/icons/chart.png') }}" alt="" width="18">
										</button>
									</a>
						    		<a href="{{ url('events/'.$event->slug) }}">
						    			<button type="button" class="btn btn-default">
										  	<img src="{{ url('images/icons/checklist.png') }}" alt="" width="18">
										</button>
									</a>
					    		</span>
					    	</p>
					    	<p class="event-time">{{ Carbon\Carbon::parse($event->started_at)->format('l, M d, Y | g.i A') }}</p>
					    	<p class="event-location">{!! nl2br(e($event->location)) !!}</p>
					   </div>
					</div>
					@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection