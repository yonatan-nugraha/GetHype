@extends('admin.index')

@section('content')
<form action="{{ url('journals') }}" method="POST">
    {!! csrf_field() !!}
    {{ method_field('POST') }}

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Journal</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="name" placeholder="Title" required pattern=".{3,50}">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="description" placeholder="Content" rows="5" required pattern=".{5,}"></textarea>
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
    alert('asd');
    //bootstrap WYSIHTML5 - text editor
    $('textarea').wysihtml5();
});
</script>
@endsection