@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Banner List</h3>
                <div class="box-tools">
                    <form action="{{ url('admin/banners') }}" method="GET">
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
                                <th width="3%">ID</th>
                                <th width="10%">Name</th>
                                <th width="10%">Type</th>
                                <th width="10%">Started At</th>
                                <th width="10%">Ended At</th>
                                <th width="6%">Status</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->name }}</td>
                                <td>
                                    @if ($banner->type == 1) Carousel Banner Front
                                    @elseif ($banner->type == 2) Small Banner Front
                                    @else Carousel Banner Search
                                    @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($banner->started_at)->format('M d, Y | g.i A') }}</td>
                                <td>{{ Carbon\Carbon::parse($banner->ended_at)->format('M d, Y | g.i A') }}</td>
                                <td>
                                    <form action="{{ url('banners/'.$banner->id.'/update-status-banner') }}" method="POST">
                                        {!! csrf_field() !!}
                                        {{ method_field('PATCH') }}
                                        <input type="checkbox" name="status" id="{{ $banner->id }}" class="status" data-size="mini" @if ($banner->status > 0) checked @endif ><br>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('admin/banners/'.$banner->id.'/edit') }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit text-blue"></i></button></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $banners->links() }}
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