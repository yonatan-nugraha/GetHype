@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Order List</h3>
                <form action="{{ url('admin/orders') }}" method="GET" class="form-horizontal" style="margin-top: 10px;">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Order</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="order_id" value="{{ Request::get('order_id') }}" placeholder="Order ID">
                            </div>

                            <label class="col-sm-2 control-label">Order Status</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="order_status">
                                    <option value="all" @if (Request::get('order_status') == 'all') selected @endif>All</option>
                                    <option value="0" @if (Request::get('order_status') == '0') selected @endif>Unprocessed</option>
                                    <option value="1" @if (Request::get('order_status') == '1') selected @endif>Pending</option>
                                    <option value="2" @if (Request::get('order_status') == '2') selected @endif>Success</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Email</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}" placeholder="Email">
                            </div>

                            <label class="col-sm-2 control-label">Payment Status</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="payment_status">
                                    <option value="all" @if (Request::get('payment_status') == 'all') selected @endif>All</option>
                                    <option value="0" @if (Request::get('payment_status') == '0') selected @endif>Unprocessed</option>
                                    <option value="1" @if (Request::get('payment_status') == '1') selected @endif>Cancelled</option>
                                    <option value="2" @if (Request::get('payment_status') == '2') selected @endif>Pending</option>
                                    <option value="3" @if (Request::get('payment_status') == '3') selected @endif>Challenged</option>
                                    <option value="4" @if (Request::get('payment_status') == '4') selected @endif>Success</option>
                                    <option value="5" @if (Request::get('payment_status') == '5') selected @endif>Settled</option>
                                    <option value="6" @if (Request::get('payment_status') == '6') selected @endif>Expired</option>
                                    <option value="7" @if (Request::get('payment_status') == '7') selected @endif>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Date</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control order-time" name="order_date" value="{{ Request::get('order_date') }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Event</th>
                                <th width="15%">Ticket</th>
                                <th width="12%">Order</th>
                                <th width="12%">Payment</th>
                                <th width="20%">User</th>
                                <th width="15%">Date</th>
                            </tr>
                        </thead>
                        <tbody style="font-weight: 400">
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->event->name }}</td>
                                <td>
                                    <table class="table table-bordered">
                                    @foreach ($order->order_details as $order_detail)
                                    <tr>
                                        <td width="70%">{{ $order_detail->ticket_group->name }}</td>
                                        <td width="30%">{{ $order_detail->quantity }}</td>
                                    </tr>
                                    @endforeach
                                    </table>
                                </td>
                                <td>
                                    @if ($order->order_status == 0)
                                    <span class="badge bg-yellow">Unprocessed</span>
                                    @elseif ($order->order_status == 1)
                                    <span class="badge bg-yellow">Pending</span>
                                    @else
                                    <span class="badge bg-green">Success</span>
                                    @endif<br>
                                    {{ 'Rp '. number_format($order->order_amount) }}
                                </td>
                                <td>
                                    @if ($order->payment_status == 0)
                                        <span class="badge bg-yellow">Unprocessed</span>
                                    @elseif ($order->payment_status == 1)
                                        <span class="badge bg-red">Cancelled</span>
                                    @elseif ($order->payment_status == 2)
                                        <span class="badge bg-yellow">Pending</span>
                                    @elseif ($order->payment_status == 3)
                                        <span class="badge bg-red">Challenged</span>
                                    @elseif ($order->payment_status == 4)
                                        <span class="badge bg-green">Success</span>
                                    @elseif ($order->payment_status == 5)
                                        <span class="badge bg-green">Settled</span>
                                    @elseif ($order->payment_status == 6)
                                        <span class="badge bg-red">Expired</span>
                                    @else
                                        <span class="badge bg-blue">Others</span>
                                        @endif<br>

                                    {{ 'Rp '. number_format($order->payment_amount) }}<br>

                                    @if ($order->payment_method == 'bank_transfer')
                                        Bank Transfer
                                    @elseif ($order->payment_method == 'credit_card')
                                        Credit Card
                                    @else
                                        Free
                                    @endif
                                </td>
                                <td>
                                    {{ $order->user->first_name . ' ' . $order->user->last_name }}<br>
                                    {{ $order->user->email }}<br>
                                    {{ $order->user->phone }}
                                </td>
                                <td>{{ Carbon\Carbon::parse($order->created_at)->format('M d, Y | g.i A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $orders->links() }}
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