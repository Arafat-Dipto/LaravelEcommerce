<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function showAddProduct(){
        $category = Category::all();
        return view('admin.addProduct',compact('category'));
    }

    public function addProduct(Request $request){
        $this->validate(request(),[
            'pro_name' => 'required|unique:products,pro_name',
            'pro_code' => 'required',
            'pro_details'=>'required',
            'pro_img'=> 'required',
            'pro_size' => 'required',
            'pro_price'=> 'required',
            'category_id' => 'required'
        ]);

        $img = uniqid().'.jpg';
        $request->pro_img->move('images',$img);

        Product::create([
            'pro_name' => request('pro_name'),
            'pro_code' => request('pro_code'),
            'pro_details'=> request('pro_details'),
            'pro_img'=> $img,
            'pro_size'=>request('pro_size'),
            'pro_price'=> request('pro_price'),
            'category_id' => request('category_id')
        ]);
        return redirect()->back();
    }


    public function showAddCategory(){
        return view('admin.addCategory');
    }

    public function addCategory(){
        $this->validate(request(),[
            'name' => 'required|unique:categories,name',
        ]);

        Category::create([
            'name' => request('name'),
            'active' => 1
        ]);

        return redirect()->back();
    }

    public function showProduct(){
        $products = Product::latest()->paginate(10);
        return view('admin.productShow',compact('products'));

    }

    public function showEditProduct($id){
        $cat_type = Category::select('name')->get();
        $pr_size = ['Small','Medium','Large','Extra Large'];
        $product = Product::find($id);
        return view('admin.editProduct',compact(['product','cat_type','pr_size']));
    }

    public function editProduct(Request $request){

        $image = Product::find(request('pro_img'));
        File::delete('images/',$image);


        $new_img = uniqid().'.jpg';
        $request->pro_img->move('images',$new_img);
        Product::find(request('id'))->update([
            'pro_name' => request('pro_name'),
            'pro_code' => request('pro_code'),
            'pro_details' => request('pro_details'),
            'pro_img' => $new_img,
            'pro_size' => request('pro_size'),
            'pro_price' => request('pro_price')

        ]);
        return redirect('/admin/product');
    }

    public function deleteProduct($id){
        Product::find($id)->delete();
        return redirect()->back();
    }
}
