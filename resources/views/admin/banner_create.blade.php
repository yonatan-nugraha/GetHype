@extends('admin.index')

@section('content')
<form action="{{ url('banners') }}" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    {{ method_field('POST') }}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Banner</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required pattern=".{3,50}">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name=type>
                            <option value="1">Carousel Banner Front</option>
                            <option value="2">Small Banner Front</option>
                            <option value="3">Carousel Banner Search</option>
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
                            <input type="text" class="form-control pull-right" name="banner_time" id="reservationtime" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link Url</label>
                        <input type="text" class="form-control" name="link_url" placeholder="Link URL" pattern=".{3,50}">
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
        startDate: moment(),
        endDate: moment().add(14, 'days'),
        timePicker: true, 
        timePickerIncrement: 30, 
        locale: {
            format: 'YYYY-MM-DD hh:mm:ss'
        }
    });
});
</script>
@endsection