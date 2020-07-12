@extends('layout.otherMaster')
@push('banner_img'){{ asset('images/bg_1.jpg') }}@endpush
@push('banner_title','Edit comment')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('user.commentEdit',$comment->id) }}" method="POST" class="p-5 bg-light">
                <div class="form-group">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{ $comment->id }}">
                    <label for="message">Message</label>
                    <textarea name="comment" id="comment" cols="40" rows="5" class="form-control">{{ $comment->comment }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Update Comment" class="btn py-3 px-4 btn-primary">
                </div>

            </form>
        </div>
    </div>
@endsection