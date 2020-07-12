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
                <h3>Product add</h3>
                @include('partials.errors')
                <form action="" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}

                    <label>Category Name</label><br>
                    <select name="category_id" id="" class="form-control">
                        @foreach($category as $c)
                            <option value="{{ $c->id }}"> {{ $c->name }}</option>
                        @endforeach
                    </select><br>
                    <label>Product Name</label>
                    <input type="text" name="pro_name" class="form-control"><br>
                    <label>Product Code</label>
                    <input type="text" name="pro_code" class="form-control"><br>
                    <label>Product Image</label>
                    <input type="file" name="pro_img" accept="image/*" class="form-control mb-3"><br>
                    <label>Product Size</label><br>
                    <select name="pro_size" id="" class="form-control">
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                        <option value="Extra Large">Extra Large</option>
                    </select><br>
                    
                    <label>Product Price</label>
                    <input type="text" name="pro_price" class="form-control"><br>
                    <label>Product Description</label><br>
                    <textarea name="pro_details" class="form-control" id="" cols="30" rows="10"></textarea><br>
                    <input type="submit" class="btn btn-primary" name="submit" value="Add">
                </form>
            </div>
        </div>
        <div class="col-lg-5">

        </div>
    </div>
    </div>
@endsection