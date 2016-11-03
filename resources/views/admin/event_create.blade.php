@extends('admin.index')

@section('content')
<form action="{{ url('events') }}" method="POST" enctype="multipart/form-data">
{!! csrf_field() !!}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">1. Event Details</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required pattern=".{3,60}">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <textarea class="form-control" name="location" rows="3" required pattern=".{5,150}" placeholder="Location"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date and Time</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="event_time" id="reservationtime" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Event Type</label>
                        <select class="form-control" name="event_type">
                            @foreach ($event_types as $event_type)
                            <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
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
                        <textarea class="form-control" name="description" rows="8" required pattern=".{5,}" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Subject Discussion</label>
                        <textarea class="form-control" name="subject_discussion" rows="5" pattern=".{5,}" placeholder="Subject Discussion"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Video URL</label>
                        <input type="text" class="form-control" name="video_url" placeholder="Video URL">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <input type="hidden" class="ticket-group" name="ticket_group_quantity" value="0">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">2. Create Tickets</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-primary pull-right btn-xs add-ticket">+ Add Ticket</button>
                        </div>
                    </div>
                    <div class="row" id="ticket-row-0">
                    </div>
                </div>
            </div>

            <input type="hidden" class="guest" name="guest_quantity" value="0">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">3. Create Guests</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-danger pull-right btn-xs add-guest">+ Add Ticket</button>
                        </div>
                    </div>
                    <div class="row" id="guest-row-0">
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
        startDate: moment(),
        endDate: moment().add(30, 'days'),
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

        $("#ticket-row-"+i).after('<div class="row" id="ticket-row-'+ticket_count+'"><div class="col-xs-7"><label>Name</label><input type="text" class="form-control" name="ticket_name_'+ticket_count+'" placeholder="Name" required pattern=".{3,50}"></div><div class="col-xs-2"><label>Quantity</label><input type="number" class="form-control" name="ticket_quantity_'+ticket_count+'" placeholder="Qty" required min="1" max="500"></div><div class="col-xs-3"><label>Price</label><input type="number" class="form-control" name="ticket_price_'+ticket_count+'" placeholder="Price" required min="0" max="5000000"></div></div>');

        $(".ticket-group").val(ticket_count);
    });

    // add guest
    var j = -1;
    var guest_count = 0;
    $('.add-guest').click(function() {
        j++;
        guest_count++;

        $('#guest-row-'+j).after('<div class="row" id="guest-row-'+guest_count+'"><div class="col-xs-4"><label>Name</label><input type="text" class="form-control" name="guest_name_'+guest_count+'" placeholder="Name" required pattern=".{3,50}"></div><div class="col-xs-4"><label>Title</label><input type="text" class="form-control" name="guest_title_'+guest_count+'" placeholder="Title" required pattern=".{3,50}"></div><div class="col-xs-4"><label>Image</label><input type="file" class="form-control" name="guest_image_'+guest_count+'"></div></div>');

        $('.guest').val(guest_count);
    });
});
</script>
@endsection