<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
//controlador para manejar el procesamiento de los comentarios
class commentsController extends Controller
{
    //funcion para guardar el comentario mediante los datos recibidos en request
    public function saveComments(Request $request)
    {
        $request->validate([
            'users_id' => 'required',
            'post_id' => 'required',
            'contenido' => 'required',
        ]);
        //método create para crear y guardar un nuevo comentario
        Comments::create([
            'users_id' => $request->users_id,
            'post_id' => $request->post_id,
            'contenido' => $request->contenido,
        ]);
        return redirect()->route('post.showPost', $request->post_id);
    }
    //funcion para eliminar un comentario, este recibe el id del comentario y nos redirije al post.
    public function destroycomments($comments){
        $comment = Comments::find($comments);
        if ($comment) {
            $comment->delete();
            return redirect()->route('post.showPost', $comment->post_id);
        }
    }
    //funcion para recibir los datos del comentario a editar y redirijimos al formulario
    public function editcomments($comments){
        $comments = Comments::where('comments_id',$comments) -> first();
        return view('comments.editcomments',compact('comments'));
    }
    //Guardar los datos de la edicion del comentario que se recibio mediante el request y metodo PUT
    public function updateComments(Comments $comments, Request $request)
    {
        $request->validate([
            'contenidocomments' => 'required',
        ]);
        //Utiliza el método update para actualizar el contenido del comentario
        $comments->update([
            'contenido' => $request->contenidocomments,
        ]);
        return redirect()->route('post.showPost', $comments->post_id);
    }
}
?>
