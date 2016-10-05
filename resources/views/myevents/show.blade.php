<style>
body {
	background-color: #F1F2F2 !important;
}

/**************************************/
/*************** Header ***************/
/**************************************/

.myevent-detail {
	margin-top: 30px;
	padding-bottom: 20px !important;
}

.event-banner img {
	width: 100%;
	max-height: 450px;
}

.myevent-header {
	margin-bottom: 30px;
	margin-left: 0 !important;
	margin-top: 30px;
}

.event-name {
	font-size: 35px;
	color: #0F3844;
}

.event-time, .event-location {
	font-size: 15px;
	color: #0F3844;
	line-height: 0.8;
}

.event-url {
	font-size: 15px;
	color: #0F3844;
	line-height: 0.8;
	margin-top: 20px;
	margin-bottom: 50px;
}

.myevent .panel {
	margin-bottom: 50px;
}

.myevent .panel-heading {
	background-color: #0F3844;
	color: #fff;
}

.myevent .panel-title {
	font-weight: 300;
}

.myevent table {

}

.myevent thead > tr {
	background-color: #0F3844;
	color: #fff;
}

.myevent thead > tr > th {
	font-size: 12px;
	font-weight: 300;
}

.myevent td {
	font-size: 12px;
}

/**************************************/
/************* Page Views *************/
/**************************************/

.myevent .event-statistic {
	max-width: 900px;
	max-height: 300px;
	margin: 50px auto;
}

.myevent .event-statistic-gender {
	max-width: 500px;
	max-height: 500px;
	display: inline !important;
}

.myevent .event-statistic-age {
	max-width: 500px;
	max-height: 500px;
	display: inline !important;
}

/**************************************/
/************** Tickets ***************/
/**************************************/

.myevent .table-revenue {
	width: 70%;
}

.myevent .summary-box {
	height: 100px;
	background-color: #F1F2F2;
	width: 22%;
	margin-right: 30px;
	text-align: center;
}

.myevent .summary-title {
	margin-top: 10px;
	font-size: 20px;
	font-weight: 300;
}

.myevent .summary-content {
	font-size: 30px;
	font-weight: 500;
}

.myevent hr {
	height: 2px;
    border-top: 1px solid #0F3844;
    border-bottom: 1px solid #0F3844;
    margin: 50px 0;
}

.myevent .ticket-statistic {
	max-width: 900px;
	max-height: 300px;
	margin: 50px auto;
}

/**************************************/
/************** Filter ****************/
/**************************************/

.myevent .filter-title {
	margin-bottom: 5px;
	font-size: 15px;
	font-weight: 300;
}

.myevent select {
	-webkit-appearance: none;
	margin-bottom: 20px;
    border: 2px solid #0F3844;
    border-radius: 0;
    color: #0F3844;
    min-width: 150px;
    padding: 5px 5px 10px 5px;
    background-color: #fff;
}

.myevent input {
	margin-bottom: 20px;
    border: 2px solid #0F3844;
    border-radius: 0;
    color: #0F3844;
    min-width: 200px;
    padding: 5px;
    background-color: #fff;
}

.myevent .daterange { 
	display: none;
}

/**************************************/
/************ Show Hide ***************/
/**************************************/

.show-hide {
	font-size: 12px;
	cursor: pointer;
}

.show-hide img {
	width: 12px;
}

.show-image {
	display: none;
}

</style>

@section('styles')
<link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">
@endsection

@extends('layouts.app')

@section('content')
<div class="row event-banner">
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
          	<button type="button" class="btn btn-default pull-right" id="daterange">
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
		  		<div class="col-xs-3 summary-box">
					<p class="summary-content total-views">{{ $total_views }}</p>
					<p class="summary-title">Views</p>
				</div>
				<div class="col-xs-9">
		    		<canvas class="event-statistic"></canvas>
		    	</div>
		    </div>
	    	<hr>
	    	<canvas class="event-statistic-gender"></canvas>
	    	<canvas class="event-statistic-age"></canvas>

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
			<canvas class="ticket-statistic"></canvas>
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

			<hr>

			<p>Summary</p>
			<div class="col-xs-3 summary-box">
				<p class="summary-title">Total Tickets Sold</p>
				<p class="summary-content total-tickets-sold">{{ $total_tickets_sold }}</p>
			</div>
			<div class="col-xs-3 summary-box">
				<p class="summary-title">Total Revenue</p>
				<p class="summary-content total-revenue">{{ 'Rp '. number_format($total_revenue) }}</p>
			</div>
			<div class="col-xs-3 summary-box">
				<p class="summary-title">Total Cost</p>
				<p class="summary-content total-cost">{{ 'Rp '. number_format($total_cost) }}</p>
			</div>
			<div class="col-xs-3 summary-box">
				<p class="summary-title">Total Profit</p>
				<p class="summary-content total-profit">{{ 'Rp '. number_format($total_profit) }}</p>
			</div>
	  	</div>
	</div>

</div>

@endsection

@section('scripts')

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="{{ asset('js/myevent.js') }}"></script>
@endsection