@extends('layout.otherMaster')
@push('banner_img','images/bg_1.jpg')
@push('banner_title','Login')

@section('content')

    <div class="login container">
        <h2 class="text-center">Login</h2>
        @include('partials.errors')
        <form class="form-group" action="{{ route('user.login') }}" method="POST">
            {{ csrf_field() }}
            <input class="form-control" type="text" name="name" placeholder="username"><br>
            <input class="form-control" type="password" name="password" placeholder="password"><br>
            <input type="submit" name="submit" value="login" class="btn btn-success">
        </form>
        <p>Sign up for an account <a href="{{ route('user.register.show') }}">Sign up</a></p>

    </div>

@endsection