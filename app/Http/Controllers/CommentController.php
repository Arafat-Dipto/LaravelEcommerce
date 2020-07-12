<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(){
        $this->validate(request(),[
            'comment' => 'required'
        ]);

        Comment::create([
            'comment' => request('comment'),
            'user_id' => Auth::id(),
            'post_id' => request('post_id')
        ]);

        return redirect()->back();
    }

    public function deleteComment($id){
        $comment = Comment::find($id);
        if(Auth::id() == $comment->user->id){
            $comment->delete();
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function editCommentShow($id){
        $comment = Comment::find($id);
        return view('editComment',compact('comment'));
    }

    public function editComment($id){

        $comment = Comment::find($id);
        if(Auth::id() == $comment->user->id){
            $comment->update([
                'comment' => request('comment')
            ]);
            return redirect('/blog/'.$comment->post_id.'/view');
        }else{
            return redirect()->back();
        }
    }

}
