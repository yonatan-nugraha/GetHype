@extends('admin.index')

@section('content')
<form action="{{ url('events') }}" method="POST">
{!! csrf_field() !!}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">1. Event Details</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location" placeholder="Location">
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
                        <select class="form-control" name=category>
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
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">2. Create Tickets</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="ticket_name" placeholder="Name">
                        </div>
                        <div class="col-xs-3">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="ticket_quantity" placeholder="Quantity">
                        </div>
                        <div class="col-xs-3">
                            <label>Price</label>
                            <input type="number" class="form-control" name="ticket_price" placeholder="Price">
                        </div>
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