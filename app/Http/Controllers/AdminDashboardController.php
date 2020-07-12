<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminDashboardController extends Controller
{
    public function showUser(){
        $users = User::all();
        $userType = ['user','moderator','admin'];
        return view('admin.user',compact(['users','userType']));
    }

    public function roleChange(){
        User::find(request('user_id'))->update([
            'role' => request('role')
        ]);

        return redirect()->back();
    }

    public function disable($id){
        User::find($id)->update([
            'verified' => 0
        ]);
        return redirect()->back();
    }
    public function enable($id){
        User::find($id)->update([
            'verified' => 1
        ]);
        return redirect()->back();
    }

    public function deleteUser($id){
        User::find($id)->delete();
        return redirect()->back();
    }

    public function createPostShow(){
        return view('admin.post');
    }

    public function createPost(Request $request){
        $this->validate(request(),[
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'details' => 'required'
        ]);
        $img = uniqid().'.jpg';
        $request->image->move('images',$img);


        User::find(Auth::id())->posts()->create([
            'title' => request('title'),
            'image' => $img,
            'details' => request('details')
        ]);

        return redirect()->back();


    }

    public function showPost(){
        $posts = Post::latest()->paginate(10);
        return view('admin.postShow',compact('posts'));

    }

    public function showEditPost($id){
        $post = Post::find($id);
        return view('admin.editPost',compact('post'));
    }

    public function editPost(Request $request){

        $image = Post::find(request('image'));
        File::delete('images/',$image);


        $new_img = uniqid().'.jpg';
        $request->image->move('images',$new_img);
        Post::find(request('id'))->update([
            'title' => request('title'),
            'image' => $new_img,
            'details' => request('details')
        ]);
        return redirect('/admin/post');
    }

    public function deletePost($id){
        Post::find($id)->delete();
        return redirect()->back();
    }


}
