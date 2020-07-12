@extends('layout.adminMaster')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Post</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.postEdit',$post->id) }}" class="form-group" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <input value="{{ $post->title }}" type="text" name="title" placeholder="Post Title" class="form-control"><br>
                <img src="{{ asset('/images/'.$post->image) }}" alt="" width="20%">
                <input type="hidden" name="prev_img" value="{{ $post->image }}" >
                <input va type="file" name="image" accept="image/*" class="form-control mb-3"><br>
                <textarea name="details" id="image-tools" cols="30" rows="10" class="form-control">{!! $post->details !!}</textarea><br>
                <input type="submit" name="submit" value="update" class="btn btn-primary btn-sm">
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        tinymce.init({
            selector: 'textarea#image-tools',
            height: 300,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools wordcount"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
@endpush