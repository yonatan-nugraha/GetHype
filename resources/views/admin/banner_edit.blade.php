@extends('admin.index')

@section('content')
<form action="{{ url('banners/'.$banner->id) }}" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Banner</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required pattern=".{3,50}" value="{{ $banner->name }}">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name=type>
                            <option value="1" @if ($banner->type == 1) selected @endif>Carousel Banner Front</option>
                            <option value="2" @if ($banner->type == 2) selected @endif>Small Banner Front</option>
                            <option value="3" @if ($banner->type == 3) selected @endif>Carousel Banner Search</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="banner_time" id="reservationtime" value="{{ $banner->started_at . ' - ' . $banner->ended_at }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link Url</label>
                        <input type="text" class="form-control" name="link_url" placeholder="Link URL" pattern=".{3,50}" value="{{ $banner->link_url }}">
                    </div>
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
});
</script>
@endsection