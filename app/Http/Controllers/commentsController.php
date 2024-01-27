<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;

class commentsController extends Controller
{
    public function savecomments(Request $request){
        $comments = new Comments();
        $comments -> users_id = $request -> users_id;
        $comments -> post_id = $request -> post_id;
        $comments -> contenido = $request -> contenido;
        $comments -> save();
        return redirect() -> route('post.showPost',$request -> post_id);
    }
    public function destroycomments($comments){
        $coment = Comments::where('comments_id',$comments) -> first();
        Comments::where('comments_id',$comments) -> first() -> delete();
        return redirect() -> route('post.showPost',$coment -> post_id);
    }
    public function editcomments($comments){
        $comments = Comments::where('comments_id',$comments) -> first();
        return view('comments.editcomments',compact('comments'));
    }
    public function updatecomments(comments $comments, Request $request){
        $comments -> contenido = $request -> contenidocomments;
        $comments -> save();
        return redirect() -> route('post.showPost',$comments -> post_id);
    }
}
