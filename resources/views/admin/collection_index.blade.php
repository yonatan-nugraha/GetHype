@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Collection List</h3>
                <div class="box-tools">
                    <form action="{{ url('admin/collections') }}" method="GET">
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
                                <th width="40%">Events</th>
                                <th width="10%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collections as $collection)
                            <tr>
                                <td>{{ $collection->id }}</td>
                                <td>{{ $collection->name }}</td>
                                <td>
                                    <ul>
                                        @foreach ($collection->event_collections as $event_collection)
                                        <li>{{ $event_collection->event->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <form action="{{ url('collections/'.$collection->id.'/update-status-collection') }}" method="POST">
                                        {!! csrf_field() !!}
                                        {{ method_field('PATCH') }}
                                        <input type="checkbox" name="status" id="{{ $collection->id }}" class="status" data-size="mini" @if ($collection->status > 0) checked @endif ><br>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('admin/collections/'.$collection->id.'/edit') }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit text-blue"></i></button></a>

                                        <a href="{{ url('collections/'.$collection->slug) }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-share text-yellow"></i></button></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $collections->links() }}
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

    // status switcher
    $('.status').bootstrapSwitch();
    $('.status').on('switchChange.bootstrapSwitch', function(event, state) {
        $(this).closest('form').submit();
    });
});
</script>
@endsection