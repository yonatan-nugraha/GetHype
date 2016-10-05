@extends('admin.index')

@section('content')
<form action="{{ url('events/'.$event->id) }}" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">1. Edit Event</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $event->name }}" required pattern=".{3,60}">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <textarea class="form-control" name="location" rows="2" required pattern=".{5,150}">{{ $event->location }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Date and Time</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right event-time" name="event_time" value="{{ $event->started_at . ' - ' . $event->ended_at }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name=category required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($event->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Event Type</label>
                        <select class="form-control" name="event_type" required>
                            @foreach ($event_types as $event_type)
                            <option value="{{ $event_type->id }}" @if ($event->event_type->id == $event_type->id) selected @endif>{{ $event_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-6" style="padding-left: 0;">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group col-xs-6" style="padding-right: 0;">
                        <label>Banner</label>
                        <input type="file" class="form-control" name="banner">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="5" required pattern=".{5,}">{{ $event->description }}</textarea>
                    </div>
                </div>      
            </div>
        </div>
        <div class="col-md-6">
            <input type="hidden" class="ticket-group" name="ticket_group_quantity" value="0">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">2. Edit/Create Tickets</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-primary btn-xs pull-right add-ticket">+ Add Ticket</button>
                        </div>
                    </div>
                    @foreach ($event->ticket_groups as $ticket_group)
                    <div class="row" id="ticket-row">
                        <div class="col-xs-7" style="margin-bottom: 5px;">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name" value="{{ $ticket_group->name }}" disabled="">
                        </div>
                        <div class="col-xs-2">
                            <label>Quantity</label>
                            <input type="number" class="form-control" placeholder="Quantity" value="{{ count($ticket_group->tickets) }}" disabled="">
                        </div>
                        <div class="col-xs-3">
                            <label>Price</label>
                            <input type="number" class="form-control" placeholder="Price" value="{{ $ticket_group->price }}" disabled="">
                        </div>
                        <div class="col-xs-7">
                            <label>Date and Time</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" class="form-control ticket-time" name="ticket_time_{{ $ticket_group->id }}" value="{{ $ticket_group->started_at . ' - ' . $ticket_group->ended_at }}">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <label>+ Qty</label>
                            <input type="number" class="form-control" name="ticket_qty_{{ $ticket_group->id }}"placeholder="Qty">
                        </div>
                        <div class="col-xs-3">
                            <label>Status</label>
                            <input type="checkbox" name="ticket_status_{{ $ticket_group->id }}" class="status" data-size="small" @if ($ticket_group->status > 0) checked @endif ><br>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="row" id="ticket-row-0">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
$(function () {
    // date range picker with time picker
    $('.event-time').daterangepicker({
        timePicker: true, 
        locale: {
            format: 'YYYY-MM-DD hh:mm:ss'
        }
    });

    $('.ticket-time').daterangepicker({
        timePicker: true, 
        locale: {
            format: 'YYYY-MM-DD hh:mm:ss'
        }
    });
    
    // add ticket
    var i = -1;
    var ticket_count = 0;
    $('.add-ticket').click(function() {
        i++;
        ticket_count++;

        $('#ticket-row-'+i).after('<div class="row" id="ticket-row-'+ticket_count+'"><div class="col-xs-7"><label>Name</label><input type="text" class="form-control" name="ticket_name_'+ticket_count+'" placeholder="Name" required pattern=".{3,50}"></div><div class="col-xs-2"><label>Quantity</label><input type="number" class="form-control" name="ticket_quantity_'+ticket_count+'" placeholder="Qty" required min="1" max="500"></div><div class="col-xs-3"><label>Price</label><input type="number" class="form-control" name="ticket_price_'+ticket_count+'" placeholder="Price" required min="0" max="5000000"></div></div>');

        $('.ticket-group').val(ticket_count);
    });

    // status switcher
    $('.status').bootstrapSwitch();
});
</script>
@endsection