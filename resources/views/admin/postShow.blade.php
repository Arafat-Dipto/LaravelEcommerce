@extends('layout.adminMaster')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Post Manager</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Post
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $key => $post)
                            <tr>

                                <td>{{ $key+1 }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <a href="{{ route('admin.postEditShow',$post->id) }}">Edit</a>&nbsp;&nbsp;
                                    <a onclick="return confirm('are you sure?');" href="{{ route('admin.postDelete',$post->id) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            {{ $posts->links() }}
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
    </div>
@endsection