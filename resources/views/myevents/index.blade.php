<style>
body {
	background-color: #F1F2F2 !important;
}

.myevents {
	margin-top: 30px;
	padding-bottom: 50px !important;
}

.myevents-header {
	margin-bottom: 30px;
	margin-left: 0 !important;
}

.myevents-title {
	font-size: 20px;
	font-weight: 600;
	color: #0F3844;
	margin-bottom: 0;
}

.myevents-content {
	font-size: 14px;
	font-weight: 300;
	color: #0F3844;
}

.myevents a {
	text-decoration: none;
	color: #0F3844;
	background-color: none;
}

.myevents a:hover {
	text-decoration: none;
	color: #0F3844;
	background-color: none;
}

/**************************************/
/********* MyEvents Sidebar ***********/
/**************************************/

.myevents-sidebar li {
	border-radius: 0;
	background-color: #fff;
}

.myevents-sidebar a {
	color: #0F3844;
	background-color: #fff;
	font-size: 13px;
}

.myevents-sidebar li.active:after {
    content: "";
    display: block;
    height: 3px;
    width: 90%;
    background: #EBD38C;
    margin: 0 auto;
}

.myevents-sidebar li.active a {
	background-color: #fff !important;
	color: #0F3844 !important;
}

.myevents-sidebar li.active a:hover {
    background-color: #F1F2F2 !important;
}

.myevents li a:hover {
	color: #0F3844 !important;
}

/**************************************/
/*********** MyEvents List ************/
/**************************************/

.myevents-list {
	max-width: 90%;
	margin-left: 60px;
}

.myevents-list-row {
	border-left: 4px solid #EBD38C;
	background-color: #fff;
	margin-bottom: 10px;
	cursor: pointer;
}

.myevents .thumbnail {
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

.event-header button {
	padding: 7px 7px;
	margin-left: 5px;
}

.event-time, .event-url {
	font-size: 11px;
	font-weight: 400;
	margin-bottom: 5px;
}

.event-location {
	font-size: 11px;
	font-weight: 400;
	line-height: 1.2;
}

</style>
@extends('layouts.app')

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
							<img src="{{ asset('/images/events/event-'.$event->id.'.jpg') }}">
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
							<img src="{{ asset('/images/events/event-'.$event->id.'.jpg') }}">
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

@section('scripts')
<script type="text/javascript" src="{{ asset('js/event.js') }}"></script>
@endsection