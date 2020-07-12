<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show(){
        if (Auth::check()) {
            $cart = \Cart::session(Auth::user()->id)->getContent();
            $subtotal = \Cart::session(Auth::user()->id)->getSubTotal();
            $total = \Cart::session(Auth::user()->id)->getTotal();
            return view('cart', compact(['cart', 'subtotal', 'total']));
        }else{
            $cart = \Cart::session(2)->getContent();
            $subtotal = \Cart::session(2)->getSubTotal();
            $total = \Cart::session(2)->getTotal();
            return view('cart', compact(['cart', 'subtotal', 'total']));
        }
    }

    public function add($id){
        $product = Product::find($id);
        if (Auth::check()) {
            \Cart::session(Auth::id())->add(array(
                'id' => $id,
                'name' => $product->pro_name,
                'price' => $product->pro_price,
                'quantity' => 1,
                'attributes' => array(
                    'size' => $product->pro_size,
                ),
            ));
            return redirect()->back();
        }else{
            \Cart::session(2)->add(array(
                'id' => $id,
                'name' => $product->pro_name,
                'price' => $product->pro_price,
                'quantity' => 1,
                'attributes' => array(
                    'size' => $product->pro_size,
                ),
            ));
            return redirect()->back();
        }

    }

    public function wishlist(){
        $cart = \Cart::session(Auth::user()->id)->getContent();
        return view('wishlist',compact('cart'));
    }

    public function addq($id){
        $product = Product::find($id);
        if (Auth::check()) {
            \Cart::session(Auth::id())->add(array(
                'id' => $id,
                'name' => $product->pro_name,
                'price' => $product->pro_price,
                'quantity' => 1,
                'attributes' => array(
                    'size' => request('size'),
                ),
            ));
            return redirect()->back();
        }else{
            \Cart::session(2)->add(array(
                'id' => $id,
                'name' => $product->pro_name,
                'price' => $product->pro_price,
                'quantity' => 1,
                'attributes' => array(
                    'size' => request('size'),
                ),
            ));
            return redirect()->back();
        }

    }
    public function remove($id){
        if (Auth::check()) {
            \Cart::session(Auth::id())->remove($id);
            return redirect()->back();
        }else{
            \Cart::session(2)->remove($id);
            return redirect()->back();
        }
    }

    public function clear(){
        if (Auth::check()) {
        \Cart::session(Auth::id())->clear();
        return redirect()->back();
        }else{
            \Cart::session(2)->clear();
            return redirect()->back();
        }
    }

    public function checkout(){
        $cart = \Cart::session(Auth::user()->id)->getContent();
        $subtotal = \Cart::session(Auth::user()->id)->getSubTotal();
        $total = \Cart::session(Auth::user()->id)->getTotal();

        $products = array();
        foreach($cart as $c) {
            $products[] = $c;
        }
        $d = count($products);
        $e = array();

        for($i = ($d-1);$i>=0;$i--)
        {
            $e = array_merge($e, array($products[$i]->name));

        }


        \Stripe\Stripe::setApiKey('sk_test_51H3Fu7Ksuepwb6QuH1VvdbcmTy29NoS5YQQoYRntBJKqZ7UPOhWKVwvpnQ8m8DHosIfqGMoYIlzND9C2uoiY9HKH00a3XAdDxO');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        
                    ],
                    'unit_amount' => $total*100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/paysuccess',
            'cancel_url' => 'https://localhost:8000/cart/checkout',
        ]);

        return view('checkout',compact(['subtotal','total','session']));
    }

    public function paysuccess(){
        return 'payment success';
    }

}
