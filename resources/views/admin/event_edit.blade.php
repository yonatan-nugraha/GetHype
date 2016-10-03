@extends('admin.index')

@section('content')
<form action="{{ url('events/'.$event->id) }}" method="POST">
    {!! csrf_field() !!}
    {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Event</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $event->name }}" required pattern=".{3,50}">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <textarea class="form-control" name="location" rows="3" required pattern=".{5,80}">{{ $event->location }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Date and Time</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="event_time" id="reservationtime" value="{{ $event->started_at . ' - ' . $event->ended_at }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name=category>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($event->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Event Type</label>
                        <select class="form-control" name="event_type">
                            @foreach ($event_types as $event_type)
                            <option value="{{ $event_type->id }}" @if ($event->event_type->id == $event_type->id) selected @endif>{{ $event_type->name }}</option>
                            @endforeach
                        </select>
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">2. Create Tickets</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-primary btn-xs pull-right add-ticket">+ Add Ticket</button>
                        </div>
                    </div>
                    @foreach ($event->ticket_groups as $ticket_group)
                    <div class="row" id="ticket-row">
                        <div class="col-xs-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="ticket_name_1" placeholder="Name" value="{{ $ticket_group->name }}" disabled="">
                        </div>
                        <div class="col-xs-3">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="ticket_quantity_1" placeholder="Quantity" value="{{ count($ticket_group->tickets) }}" disabled="">
                        </div>
                        <div class="col-xs-3">
                            <label>Price</label>
                            <input type="number" class="form-control" name="ticket_price_1" placeholder="Price" value="{{ $ticket_group->price }}" disabled="">
                        </div>
                    </div>
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
    $('#reservationtime').daterangepicker({
        timePicker: true, 
        timePickerIncrement: 30, 
        locale: {
            format: 'YYYY-MM-DD hh:mm:ss'
        }
    });
    
    // add ticket
    var i = -1;
    var ticket_count = 0;
    $(".add-ticket").click(function() {
        i++;
        ticket_count++;

        $("#ticket-row-"+i).after('<div class="row" id="ticket-row-'+ticket_count+'"><div class="col-xs-6"><label>Name</label><input type="text" class="form-control" name="ticket_name_'+ticket_count+'" placeholder="Name" required pattern=".{3,20}"></div><div class="col-xs-3"><label>Quantity</label><input type="number" class="form-control" name="ticket_quantity_'+ticket_count+'" placeholder="Quantity" required min="1" max="500"></div><div class="col-xs-3"><label>Price</label><input type="number" class="form-control" name="ticket_price_'+ticket_count+'" placeholder="Price" required min="0" max="5000000"></div></div>');

        $(".ticket-group").val(ticket_count);
    });
});
</script>
@endsection