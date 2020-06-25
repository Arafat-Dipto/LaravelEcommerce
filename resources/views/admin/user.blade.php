@extends('layout.adminMaster')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Users</h1>
        </div>
    </div>
    <div class="row col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            User Info
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form method="POST" action="{{ url('/admin/roleChange') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <select name="role" id="">
                                @foreach($userType as $type)
                                    @if($type == $user->role)
                                        <option selected value="{{ $user->role }}">{{ $type }}</option>
                                    @else
                                        <option value="{{ $type}}">{{ $type }}</option>
                                    @endif
                                @endforeach
                            </select>
                                <input type="submit" name="submit" value="update">
                            </form>
                        </td>
                        <td>
                            @if($user->verified == 1)
                                <a class="btn btn-warning btn-sm" href="{{ url('/admin/'.$user->id.'/disable') }}">Disable</a>
                            @else
                                <a class="btn btn-success btn-sm" href="{{ url('/admin/'.$user->id.'/enable') }}">Enable</a>
                            @endif
                            &nbsp;&nbsp;<a onclick="return confirm('are you sure?');"  class="btn btn-danger btn-sm" href="{{ url('/admin/'.$user->id.'/deleteUser') }}">Delete</a></td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>
    </div>
@endsection