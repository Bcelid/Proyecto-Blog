<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comments;
use App\Models\User;

class postcontroller extends Controller
{
    public function home(){
        $contenido = post::All();
        return view('post.home', compact('contenido'));
    }
    public function create(){
        return view('post.createPost');
    }
    public function savepost(Request $request){
        $post = new post();
        $post -> titulo = $request -> titulo;
        $post -> contenido = $request -> contenido;
        $post -> users_id = $request -> id;
        $post -> save();
        return redirect() -> route('home');
    }
    public function showPost($post_id){
        $post = post::where('post_id',$post_id)
        -> join('users','posts.users_id', '=','users.id')
        -> select('posts.post_id as post_id','posts.titulo as titulo','posts.contenido as contenido','posts.created_at as created_at','users.id as users_id','users.name as name')
        -> first();
        $comentario = Comments::where('post_id', $post_id) 
        ->join('users', 'comments.users_id', '=', 'users.id') 
        ->select('comments.comments_id', 
        'users.name as nombre_usuario','users.id as id_usuarios', 'comments.contenido', 'comments.created_at') 
        -> get();
        return view('post.showPost',compact('post','comentario'));
    }
    public function editPost($post_id){
        $post = post::where('post_id',$post_id)
        -> join('users','posts.users_id', '=','users.id')
        -> select('posts.post_id as post_id','posts.titulo as titulo','posts.contenido as contenido','posts.created_at as created_at','users.id as users_id','users.name as name')
        -> first();
        return view('post.editPost',compact('post'));
    }
    public function updatePost(post $post_id, Request $request){
        $post_id -> titulo = $request -> titulo;
        $post_id -> contenido = $request -> contenido;
        $post_id -> save();

        $post = post::where('post_id',$post_id -> post_id)
        -> join('users','posts.users_id', '=','users.id')
        -> select('posts.post_id as post_id','posts.titulo as titulo','posts.contenido as contenido','posts.created_at as created_at','users.id as users_id','users.name as name')
        -> first();

        $comentario = Comments::where('post_id', $post_id -> post_id) 
        ->join('users', 'comments.users_id', '=', 'users.id') 
        ->select('comments.comments_id', 
        'users.name as nombre_usuario','users.id as id_usuarios', 'comments.contenido', 'comments.created_at') 
        -> get();

        return view('post.showPost',compact('post','comentario'));
    }
    public function destroyPost(post $post){
        $post->comments()->delete(); // Elimina los comentarios asociados al post
        $post->delete(); // Elimina el post
        return redirect() -> route('home');
    }
    
}
