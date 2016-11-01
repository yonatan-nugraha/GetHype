@extends('admin.index')

@section('content')
<form action="{{ url('journals/'.$journal->id) }}" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Journal</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" required pattern=".{3,50}" value="{{ $journal->title }}">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content" rows="20" required pattern=".{5,}">{{ $journal->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Tag</label>
                        <input type="text" class="form-control" name="tag" placeholder="Tag" required pattern=".{3,50}" value="{{ $journal->tag }}">
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
    //bootstrap WYSIHTML5 - text editor
    $('textarea').wysihtml5();
});
</script>
@endsection