<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Post;
use App\Product;
use App\User;
use App\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(){

        return view('index');
    }

    public function about(){
        return view('about');
    }

    public function blog(){
        $posts = \App\Post::latest()->paginate(5);
        return view('blog',compact('posts'));
    }

    public function blogView($id){
        $post = \App\Post::find($id);
        $comments = $post->comment;
        $posts = \App\Post::latest()->paginate(5);
        return view('blogsingle',compact(['post','posts','comments']));
    }
    public function contact(){
        return view('contact');
    }

    public function shop(){
        $products = Product::latest()->paginate(12);
        return view('shop',compact('products'));
    }

    public function productsingle($id){
        $product = \App\Product::find($id);
        $products = \App\Product::where('category_id',$product->category_id)->get();
        return view('singleproduct',compact(['product','products']));
    }


    public function showlogin(){
        return view('login');
    }

    public function login(){
        $this->validate(request(),[
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['name' => request('name'), 'password' => request('password'),'role' => 'user','verified' => 1])){
            return redirect('/');
        }elseif (Auth::attempt(['name' => request('name'), 'password' => request('password'),'role' => 'moderator','verified' => 1])){
            return redirect('admin/dashboard');
        }else{
            return 'credential does not match';
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function showregister(){
        return view('register');
    }
    public function register(){

        $this->validate(request(),[
            'name' => 'required|alpha_dash|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'verified' => 0,
            'role' => 'user'
        ]);

        $token = Verify::create([
            'token' => md5(uniqid()),
            'user_id' => $user->id
        ]);

        Mail::to(request('email'))->send(new SendMail($token->token));

        return redirect('/')->with('regSuccess','User registered successful');
    }

    public function verify($token){
        $result = Verify::where('token',$token)->get();
        if(count($result) >= 1){
            $result = $result->first()->user_id;
            User::find($result)->update([
                'verified' => 1
            ]);
            return redirect('/')->with('verifySuccess','Email Verified');
        }else{
            return 'Invalid Request try again';
        }
    }

    public function search(){
        $search = request('search_value');
        $posts = \App\Post::where('title','LIKE','%'.$search.'%')->paginate(5);
        return view('blog',compact('posts'));
    }
}
