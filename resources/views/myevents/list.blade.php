@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/myevent-list.css') }}">
@endsection

@section('content')
<div class="container myevents">
	<div class="row myevents-header">
		<p class="myevents-title">Find Your Happiness!</p>
		<p class="myevents-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	</div>
	<div class="row myevents-body">
		<div class="col-xs-2 myevents-sidebar">
			<ul class="nav nav-pills nav-stacked">
			  	<li class="active"><a data-toggle="tab" href="#upcoming-events">Upcoming Events</a></li>
			  	<li><a data-toggle="tab" href="#past-events">Past Events</a></li>
			</ul>
		</div>
		<div class="col-xs-10">
			<div class="tab-content">
				<div class="tab-pane fade in active myevents-list" id="upcoming-events">
					@foreach ($events as $event)
					@if (Carbon\Carbon::now() <= $event->ended_at)
					<div class="row myevents-list-row" id="{{ $event->id }}">
						<div class="col-xs-2 thumbnail">
							<img src="{{ asset('/images/events/'.$event->image()) }}">
						</div>
						<div class="col-xs-10">
					    	<p class="event-header">
					    		<span class="event-name">{{ $event->name }}</span>
					    		<span class="event-share">
					    			<a class="pull-right" href="{{ url('myevents/'.$event->id.'/statistic') }}">
										<button type="button" class="btn btn-default">
										  	<i class="fa fa-bar-chart"></i>
										</button>
									</a>
						    		<a class="pull-right" href="{{ url('events/'.$event->slug) }}">
						    			<button type="button" class="btn btn-default">
										  	<i class="fa fa-external-link"></i>
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
					    			<a class="pull-right" href="{{ url('myevents/'.$event->id.'/statistic') }}">
										<button type="button" class="btn btn-default">
										  	<i class="fa fa-bar-chart"></i>
										</button>
									</a>
						    		<a class="pull-right" href="{{ url('events/'.$event->slug) }}">
						    			<button type="button" class="btn btn-default">
										  	<i class="fa fa-external-link"></i>
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