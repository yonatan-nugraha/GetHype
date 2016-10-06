@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Order List</h3>
                <div class="box-tools">
                    <form action="{{ url('admin/orders') }}" method="GET">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="q" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
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
                                    <span class="badge bg-yellow">Pending</span>
                                    @elseif ($order->order_status == 1)
                                    <span class="badge bg-red">Failed</span>
                                    @else
                                    <span class="badge bg-green">Success</span>
                                    @endif<br>
                                    {{ 'Rp '. number_format($order->order_amount) }}
                                </td>
                                <td>
                                        @if ($order->payment_status == 0)
                                        <span class="badge bg-yellow">Pending</span>
                                        @elseif ($order->payment_status == 1)
                                        <span class="badge bg-red">Failed</span>
                                        @elseif ($order->payment_status == 2)
                                        <span class="badge bg-red">Rejected</span>
                                        @elseif ($order->payment_status == 3)
                                        <span class="badge bg-red">Cancelled</span>
                                        @elseif ($order->payment_status == 4)
                                        <span class="badge bg-red">Success</span>
                                        @elseif ($order->payment_status == 5)
                                        <span class="badge bg-green">Settled</span>
                                        @else
                                        <span class="badge bg-blue">Others</span>
                                        @endif<br>
                                    {{ 'Rp '. number_format($order->order_amount) }}<br>
                                    {{ $order->payment_type }}
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
});
</script>
@endsection