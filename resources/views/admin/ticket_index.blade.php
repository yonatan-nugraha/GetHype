@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-bticket">
                <h3 class="box-title">Ticket List</h3>
                <form action="{{ url('admin/tickets') }}" method="GET" class="form-horizontal" style="margin-top: 10px;">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Ticket</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="code" value="{{ Request::get('code') }}" placeholder="Code">
                            </div>

                            <label class="col-sm-2 control-label">Order</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="order_id" value="{{ Request::get('order_id') }}" placeholder="Order ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Email</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}" placeholder="Email">
                            </div>

                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="status">
                                    <option value="all" @if (Request::get('status') == 'all') selected @endif>All</option>
                                    <option value="0" @if (Request::get('status') == '0') selected @endif>Unavailable</option>
                                    <option value="1" @if (Request::get('status') == '1') selected @endif>Available</option>
                                    <option value="2" @if (Request::get('status') == '2') selected @endif>Booked</option>
                                    <option value="3" @if (Request::get('status') == '3') selected @endif>Sold</option>
                                    <option value="4" @if (Request::get('status') == '4') selected @endif>Registered</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Date</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control order-time" name="order_date" value="{{ Request::get('order_date') }}" required>
                            </div>
                        </div>
                        <a href="{{ url('/admin/tickets') }}"><button type="button" class="btn btn-primary">Clear</button></a>
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <div class="box-body">
                    <table class="table table-bticketed">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Code</th>
                                <th width="15%">Event</th>
                                <th width="15%">Group</th>
                                <th width="10%">Price</th>
                                <th width="10%">Status</th>
                                <th width="20%">Order</th>
                            </tr>
                        </thead>
                        <tbody style="font-weight: 400">
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->code }}</td>
                                <td>{{ $ticket->ticket_group->event->name }}</td>
                                <td>{{ $ticket->ticket_group->name }}</td>
                                <td>{{ 'Rp '. number_format($ticket->ticket_group->price) }}</td>
                                <td>
                                    @if ($ticket->status == 0)
                                    <span class="badge bg-red">Unavailable</span>
                                    @elseif ($ticket->status == 1)
                                    <span class="badge bg-green">Available</span>
                                    @elseif ($ticket->status == 2)
                                    <span class="badge bg-yellow">Booked</span>
                                    @elseif ($ticket->status == 3)
                                    <span class="badge bg-blue">Sold</span>
                                    @else
                                    <span class="badge bg-purple">Registered</span>
                                    @endif<br>
                                </td>
                                <td>
                                    @if (in_array($ticket->status, [3,4]))
                                    {{ $ticket->order_id }}<br>
                                    {{ $ticket->order->user->email }}<br>
                                    {{ Carbon\Carbon::parse($ticket->updated_at)->format('M d, Y | g.i A') }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function () {
    $('.pagination').addClass('pagination-sm no-margin pull-right');

    $('.order-time').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
});
</script>
@endsection