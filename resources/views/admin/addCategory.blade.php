@extends('layout.adminMaster')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Product</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="card p-3">
                    <h3>Add Category</h3>
                    <form action="{{ url('/admin/addCategory') }}" method="POST">
                        {{ csrf_field() }}
                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control"><br>
                        <input type="submit" class="btn btn-primary" name="submit" value="Add">
                    </form>
                </div>
            </div>
            <div class="col-lg-5">

            </div>
        </div>
    </div>
@endsection