@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Event List</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Event Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->name }}</td>
                                <th>{{ Carbon\Carbon::parse($event->started_at)->format('M d, Y') }}</th>
                                <th>{{ $event->location }}</th>
                                <th>{{ $event->category->name }}</th>
                                <td>{{ $event->event_type->name }}</td>
                                <td>
                                    @if ($event->status == 0)
                                        <span class="label label-warning">Inactive</span>
                                    @elseif ($event->status == 1)
                                        <span class="label label-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('admin/events/'.$event->id.'/edit') }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit text-blue"></i></button></a>

                                        <a href="{{ url('events/'.$event->slug) }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-share text-yellow"></i></button></a>
                                    </div>
                                    <div class="btn-group">
                                        <form action="{{ url('events/'.$event->id.'/update-status') }}" method="POST">
                                            {!! csrf_field() !!}
                                            {{ method_field('PATCH') }}
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection