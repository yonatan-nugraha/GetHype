@section('styles')
<link rel="stylesheet" href="{{ asset('css/daterangepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/myevent-statistic.css') }}">
@endsection

@extends('layouts.app')

@section('content')
<div class="event-banner">
    <img src="{{ asset('/images/events/'.$event->banner()) }}">
</div>

<div class="container myevent">
	<div class="myevent-header">
		<input class="event-id" type="hidden" value="{{ $event->id }}">
		<p class="event-name">{{ $event->name }}</p>
		<p class="event-time">{{ Carbon\Carbon::parse($event->started_at)->format('l, M d, Y | g.i A') }}</p>
		<p class="event-location">{{ $event->location }}</p>
		<p class="event-url">Event page URL : <a href="{{ url('events/'.$event->slug) }}" target="_blank">{{ url('events/'.$event->slug) }}</a></p>
	</div>

	<p class="filter-title">Filter by:</p>
	<div class="form-group">
        <div class="input-group">
          	<button type="button" class="btn btn-default" id="daterange">
            	<span>
              		<i class="fa fa-calendar"></i> Date Range
            	</span>
            	<i class="fa fa-caret-down"></i>
          	</button>
        </div>
    </div>

	<div class="panel page-views-panel">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Page Views
	    		<span class="pull-right show-hide">
	    			<span>Hide</span>
	    			<img class="show-image" src="{{ asset('images/icons/show.png') }}">
    				<img class="hide-image" src="{{ asset('images/icons/hide.png') }}">
    			</span>
	    	</h3>
	  	</div>
	  	<div class="panel-body">
	  		<p>Event Activity</p>
	  		<div class="row">
		  		<div class="col-xs-12 col-sm-3 summary-box">
					<p class="summary-content total-views">{{ $total_views }}</p>
					<p class="summary-title">Views</p>
				</div>
				<div class="col-xs-12 col-sm-9">
					<div id="views-statistic" ></div>
		    	</div>
		    </div>
	    	<hr>
	    	<div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div id="gender"></div>
                </div>

                <div class="col-xs-12 col-sm-8">
                    <div id="age"></div>
                </div>
            </div>
	  	</div>
	</div>

	<div class="panel order-details-panel">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Ticket Selling
	    		<span class="pull-right show-hide">Hide
	    			<img class="show-image" src="{{ asset('images/icons/show.png') }}">
    				<img class="hide-image" src="{{ asset('images/icons/hide.png') }}">
    			</span>
	    	</h3>
	  	</div>
	  	<div class="panel-body">
			<p>Order Details</p>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
				  	<thead>
				    	<tr>
				      		<th>Order #</th>
				      		<th>Name</th>
				      		<th>Email</th>
				     	 	<th>Ticket Name</th>
				     	 	<th>QTY</th>
				     	 	<th>Date</th>
				    	</tr>
				  	</thead>
				  	<tbody class="order-details">
				  		@forelse ($order_details as $od)
				    	<tr>
				      		<td>{{ $od->id }}</td>
				      		<td>{{ $od->first_name . ' '. $od->last_name }}</td>
				      		<td>{{ $od->email }}</td>
				      		<td>{{ $od->name }}</td>
				      		<td>{{ $od->quantity }}</td>
				      		<td>{{ Carbon\Carbon::parse($od->created_at)->format('M d, Y | g.i A') }}</td>
				    	</tr>
				    	@empty
				    	<tr align="center">
				      		<td colspan="6">No Orders Yet</td>
				      	</tr>
				    	@endforelse
				  	</tbody>
				</table>
			</div>
			<input class="total-orders" type="hidden" value="{{ $total_orders }}">
			<input class="orders-limit" type="hidden" value="{{ $orders_limit }}">
			
			@if ($total_orders > $orders_limit)
			<ul class="pagination">
				<li class="laquo" id="0"><a>&laquo;</a></li>
				@for ($i = 0; $i < $total_orders / $orders_limit; $i++)
			  	<li class="@if ($i == 0) active first @elseif ($i == $total_orders / $orders_limit - 1) last @endif" id="{{ $i }}"><a>{{ $i+1 }}</a></li>
			  	@endfor
			  	<li class="raquo" id="{{ $total_orders/$orders_limit - 1 }}"><a>&raquo;</a></li>
			</ul>
			@endif
			<hr>
			<div id="ticket-statistic"></div>
	  	</div>
	</div>

	<div class="panel ticket-sales-panel">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Revenue
	    		<span class="pull-right show-hide">Hide
	    			<img class="show-image" src="{{ asset('images/icons/show.png') }}">
    				<img class="hide-image" src="{{ asset('images/icons/hide.png') }}">
    			</span>
	    	</h3>
	  	</div>
	  	<div class="panel-body">
	    	<p>Ticket Sales</p>
	    	<div class="table-responsive">
		    	<table class="table table-striped table-hover table-bordered table-revenue">
				  	<thead>
				    	<tr>
				      		<th>Ticket Name</th>
				      		<th>Sold</th>
				      		<th>Remaining</th>
				      		<th>Price</th>
				     	 	<th>Revenue</th>
				    	</tr>
				  	</thead>
				  	<tbody class="ticket-sales">
				  		@forelse ($ticket_sales as $ts)
				    	<tr>
				      		<td>{{ $ts->name }}</td>
				      		<td>{{ $ts->tickets_sold }}</td>
				      		<td>{{ $ts->total_tickets - $ts->tickets_sold }}</td>
				      		<td>{{ 'Rp '. number_format($ts->price) }}</td>
				      		<td>{{ 'Rp '. number_format($ts->tickets_sold * $ts->price) }}</td>
				    	</tr>
				    	@empty
				    	<tr align="center">
				      		<td colspan="6">No Ticket Sales Yet</td>
				      	</tr>
				    	@endforelse
				  	</tbody>
				</table>
			</div>
			<hr>
			<p>Summary</p>
			<div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="summary-box">
						<p class="summary-title">Total Tickets Sold</p>
						<p class="summary-content total-tickets-sold">{{ $total_tickets_sold }}</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="summary-box">
						<p class="summary-title">Total Revenue</p>
						<p class="summary-content total-revenue">{{ 'Rp '. number_format($total_revenue) }}</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="summary-box">
						<p class="summary-title">Total Cost</p>
						<p class="summary-content total-cost">{{ 'Rp '. number_format($total_cost) }}</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="summary-box">
						<p class="summary-title">Total Profit</p>
						<p class="summary-content total-profit">{{ 'Rp '. number_format($total_profit) }}</p>
					</div>
				</div>
			</div>
	  	</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/daterangepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/exporting.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/myevent.js') }}"></script>
@endsection