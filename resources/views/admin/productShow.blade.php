@extends('layout.adminMaster')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product Manager</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Product
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Details</th>
                                <th>Image</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>

                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->pro_name }}</td>
                                    <td>{{ $product->pro_code }}</td>
                                    <td>{{ $product->pro_details }}</td>
                                    <td>{{ $product->pro_img }}</td>
                                    <td>{{ $product->pro_size }}</td>
                                    <td>{{ $product->pro_price }}</td>
                                    <td>
                                        <a href="{{ route('admin.productEditShow',$product->id) }}">Edit</a>&nbsp;&nbsp;
                                        <a onclick="return confirm('are you sure?');" href="{{ route('admin.productDelete',$product->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            {{ $products->links() }}

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