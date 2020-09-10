<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        /* Este middleware se encuentra en Kernel.php, en la variable protected $routeMiddleware */
        $this->middleware('auth');
    }

    public function save(Request $request){

        //Gracias a este método validamos los datos del formulario (a nivel de servidor no de cliente)
        //que nos llegan a request
        $validate = $this->validate($request,[
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        //Recoger datos del form
        $user = \Auth::user();

        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asigno los valores al nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardar en BD
        $comment->save();


        //Redirección
        return redirect()->route('image.detail',['id' => $image_id])
                        ->with([
                            'message' => 'Has publicado tu comentario correctamente'
                        ]);

    }

    public function delete($id){

        //Conseguir datos del usuario identificado
        $user = \Auth::user();

        //Conseguir objeto del comentario
        $comment = Comment::find();

        //Comprobar si accede el dueño de la publicación o del comentario
        if($user && ($comment->user_id) == $user->id || $comment->image == $user->id){
            $comment->delete();

            //Redirección
            return redirect()->route('image.detail',['id' => $comment->image->id])
            ->with([
                'message' => 'Comentario eliminado correctamente'
            ]);
        }else{
            //Redirección
            return redirect()->route('image.detail',['id' => $comment->image->id])
            ->with([
                'message' => 'No se ha podido eliminar el comentario'
            ]);
        }
    }
}
