@extends('layout.adminMaster')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Product Details</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <label>Category Name</label><br>
                <select name="category_id" id="" class="form-control">
                    @foreach($cat_type as $type)
                        @if($type['name'] == $product->category->name)
                            <option selected value="{{ $product->category->name }}">{{ $type['name'] }}</option>
                        @else
                            <option value="{{ $type['name'] }}">{{ $type['name'] }}</option>
                        @endif
                    @endforeach
                </select><br>
                <label>Product Name</label>
                <input type="text" name="pro_name" value="{{ $product->pro_name }}" class="form-control"><br>
                <label>Product Code</label>
                <input type="text" name="pro_code" value="{{ $product->pro_code }}" class="form-control"><br>
                <label>Product Image</label>
                <img src="{{ asset('/images/'.$product->pro_img) }}" alt="" width="20%">
                <input type="hidden" name="prev_img" value="{{ $product->Pro_img }}" >
                <input type="file" name="pro_img" accept="image/*" class="form-control mb-3"><br>
                <label>Product Size</label><br>
                <select name="pro_size" id="" class="form-control">
                    @foreach($pr_size as $ps)
                        @if($ps == $product->pro_size)
                            <option selected value="{{ $product->pro_size }}">{{ $ps }}</option>
                        @else
                            <option value="{{ $ps }}">{{ $ps }}</option>
                        @endif
                    @endforeach
                </select><br>

                <label>Product Price</label>
                <input type="text" name="pro_price" value="{{ $product->pro_price }}" class="form-control"><br>
                <label>Product Description</label><br>
                <textarea name="pro_details" class="form-control" id="" cols="30" rows="10">{{ $product->pro_details }}</textarea><br>
                <input type="submit" class="btn btn-primary" name="submit" value="Update">
            </form>
        </div>
    </div>
@endsection

