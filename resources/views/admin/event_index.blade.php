@extends('admin.index')

@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Event List</h3>
                <div class="box-tools">
                    <form action="{{ url('admin/events') }}" method="GET">
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Name</th>
                                <th width="15%">Date</th>
                                <th width="20%">Location</th>
                                <th width="8%">Category</th>
                                <th width="8%">Event Type</th>
                                <th width="8%">Status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ Carbon\Carbon::parse($event->started_at)->format('M d, Y | g.i A') }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->category->name }}</td>
                                <td>{{ $event->event_type->name }}</td>
                                <td>
                                    <form action="{{ url('events/'.$event->id.'/update-status-event') }}" method="POST">
                                        {!! csrf_field() !!}
                                        {{ method_field('PATCH') }}
                                        <input type="checkbox" name="status" id="{{ $event->id }}" class="status" data-size="mini" @if ($event->status > 0) checked @endif ><br>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('admin/events/'.$event->id.'/edit') }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit text-blue"></i></button></a>

                                        <a href="{{ url('events/'.$event->slug) }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-rocket text-yellow"></i></button></a>

                                        <a data-toggle="modal" data-target="#edit-user-event-{{ $event->id }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-user-plus text-green"></i></button></a>
                                    </div>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                            <i class="fa fa-beer text-red"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach ($collections as $collection)
                                            <li><a href="{{ url('collections/add-event?collection_id='.$collection->id.'&event_id='.$event->id) }}">{{ $collection->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($events as $event)
<div class="modal fade" tabindex="-1" role="dialog" id="edit-user-event-{{ $event->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Assign an Owner</h4>
            </div>
            <div class="modal-body">
                <p id="update-message-{{ $event->id }}"></p>
                <input type="text" class="form-control email" id="email-{{ $event->id }}" event_id="{{ $event->id }}" value="{{ $event->user->email }}" placeholder="Email">
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-user-event" id="{{ $event->id }}">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function () {
    // status switcher
    $('.status').bootstrapSwitch();
    $('.status').on('switchChange.bootstrapSwitch', function(event, state) {
        $(this).closest('form').submit();
    });

    $('.pagination').addClass('pagination-sm no-margin pull-right');

    $('.email').keyup(function() {
        var email   = $(this).val();
        var event_id = $(this).attr('event_id');
        console.log(event_id);

        $.ajax({
            url: '/users/get-email-list?email='+email, 
            type: 'GET',
            success: function(result) {
                $('#email-'+event_id).autocomplete({
                    source: result,
                    appendTo : $('#edit-user-event-'+event_id)
                });
            }
        });
    });

    $('.update-user-event').click(function() {
        var event_id = $(this).attr('id');
        var email    = $('#email-'+event_id).val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: '/events/'+event_id+'/update-user-event', 
            type: 'POST',
            data: {email: email},
            success: function(result) {
                if (result.success == 1) {
                    location.href = '/admin/events';
                } else {
                    $('#update-message-'+event_id).text(result.message);
                }
            }
        });
    });
});
</script>
@endsection