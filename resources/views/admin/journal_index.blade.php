@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Journal List</h3>
                <div class="box-tools">
                    <form action="{{ url('admin/journals') }}" method="GET">
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
                                <th width="20%">Title</th>
                                <th width="55%">Content</th>
                                <th width="10%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($journals as $journal)
                            <tr>
                                <td>{{ $journal->id }}</td>
                                <td>{{ $journal->title }}</td>
                                <td style="text-overflow: ellipsis; max-width: 800px; overflow: hidden; white-space: nowrap;">{{ strip_tags($journal->content) }}</td>
                                <td>
                                    <form action="{{ url('journals/'.$journal->id.'/update-status-journal') }}" method="POST">
                                        {!! csrf_field() !!}
                                        {{ method_field('PATCH') }}
                                        <input type="checkbox" name="status" id="{{ $journal->id }}" class="status" data-size="mini" @if ($journal->status > 0) checked @endif ><br>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('admin/journals/'.$journal->id.'/edit') }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit text-blue"></i></button></a>

                                        <a href="{{ url('journals/'.$journal->slug) }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-share text-yellow"></i></button></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $journals->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function () {
    // status switcher
    $(".status").bootstrapSwitch();
    $(".status").on('switchChange.bootstrapSwitch', function(event, state) {
        $(this).closest('form').submit();
    });

    $('.pagination').addClass('pagination-sm no-margin pull-right');
});
</script>
@endsection