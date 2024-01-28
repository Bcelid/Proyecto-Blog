<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class postcontroller extends Controller
{
    //funcion home para mostrar todos los post
    public function home(){
        //los post se presentan de manera descendente por la fecha de modificacion
        $contenido = Post::orderBy('updated_at', 'desc')->get();
        return view('post.home', compact('contenido'));
    }
    //funcion para redirigir al formulario para crear un post
    public function create(){
        return view('post.createPost');
    }
    //funcion para guardar el post mediante los datos enviados por el request
    public function savepost(Request $request)
    {
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->contenido = $request->contenido;
        $post->users_id = $request->id;
        if ($post->save()) {
            // Post creado correctamente
            Session::flash('new_post', '¡Post creado correctamente!');
        } else {
            // Error al crear el post
            Session::flash('error_newpost', 'Error al crear el post. Inténtelo de nuevo.');
        }
        // Redirigimos al home
        return redirect()->route('home');
    }
    //funcion para mostrar un post especifico con sus comentarios
    public function showPost($post_id){
        //consulta para obtener los post y el usuario creador
        $post = post::where('post_id',$post_id)
        -> join('users','posts.users_id', '=','users.id')
        -> select('posts.post_id as post_id','posts.titulo as titulo','posts.contenido as contenido','posts.created_at as created_at','users.id as users_id','users.name as name')
        -> first();
        //consulta para obtener los comentarios con los datos del autor de los mismos
        $comentario = Comments::where('post_id', $post_id) 
        ->join('users', 'comments.users_id', '=', 'users.id') 
        ->select('comments.comments_id', 
        'users.name as nombre_usuario','users.id as id_usuarios', 'comments.contenido', 'comments.created_at') 
        -> orderBy('comments_id', 'desc')
        -> get();
        //retornamos la vista con los datos cargados
        return view('post.showPost',compact('post','comentario'));
    }
    //funcion para editar el post, mediante el id que recibimos hacemos la consulta 
    public function editPost($post_id){
        $post = post::where('post_id',$post_id)
        -> join('users','posts.users_id', '=','users.id')
        -> select('posts.post_id as post_id','posts.titulo as titulo','posts.contenido as contenido','posts.created_at as created_at','users.id as users_id','users.name as name')
        -> first();
        //enviamos cargado el formulario
        return view('post.editPost',compact('post'));
    }
    //Guardamos los cambios
    public function updatePost(post $post_id, Request $request){
        $post_id -> titulo = $request -> titulo;
        $post_id -> contenido = $request -> contenido;
        $post_id -> save();
        if ($post_id->save()) {
            // Post editado correctamente
            Session::flash('edit_post', '¡Post Editado correctamente!');
        } else {
            // Error al editar el post
            Session::flash('error_editpost', 'Error al editar el post. Inténtelo de nuevo.');
        }
        return redirect() -> route('post.showPost',$post_id -> post_id);
    }
    //Eliminamos un post y retornamos al home
    public function destroyPost(post $post){
        $post->comments()->delete(); // Elimina los comentarios asociados al post
        // Elimina el post
        if ($post->delete()) {
            // Post creado correctamente
            Session::flash('delete_post', '¡Post Eliminado correctamente!');
        } else {
            // Error al crear el post
            Session::flash('error_deletepost', 'Error al eliminar el post. Inténtelo de nuevo.');
        }
        return redirect() -> route('home');
    }
    
}
