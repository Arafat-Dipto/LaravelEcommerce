@extends('layout.otherMaster')
@push('banner_img','images/bg_1.jpg')
@push('banner_title','Register')

@section('content')

    <div class="register container">
        <h2 class="text-center">Register</h2>
        @include('partials.errors')
        <form class="form-group" action="" method="POST">
            {{ csrf_field() }}
            <input class="form-control" type="text" name="name" placeholder="username"><br>
            <input class="form-control" type="email" name="email" placeholder="email"><br>
            <input class="form-control" type="password" name="password" placeholder="password"><br>
            <input class="form-control" type="password" name="password_confirmation" placeholder="confirm password"><br>
            <input type="submit" name="submit" value="Register" class="btn btn-success">
        </form>
        <p>Already have an account <a href="{{ route('user.login.show') }}">Login</a></p>
    </div>

@endsection