<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\Image; //para poder crear objetos de tipo image
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    // Acceso para solo los usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        //Validación
        //$this->validate es un método que trae ya laravel
        //donde pasaremos los datos del request y las reglas que deben cumplir en un array
        //al campo descripcion le imponemos que sea requried y al img_path a parte también
        //le indicamos los formatos que debe traer
        $validate = $this->validate($request, [
            'description' => 'required',
            /* 'image_path' => 'required|mimes:jpg,jpeg,png,gif', */ //esto es igual a poner image
            'image_path' => 'required|image'
         ]);

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar valores nuevo objeto
        $user = \Auth::user();

        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

            //Sufir fichero
            if($image_path){
                $image_path_name = time() . $image_path->getClientOriginalName();
                //Meto la imagen que se encuentra en el archivo temporal creado justo después de enviar los datos por
                //el formulario, y con el método get de la clase File lo sacamos de ahí y lo metemos en la carpeta
                //images de storage
                Storage::disk('images')->put($image_path_name,File::get($image_path));
                //guaradmos el mismo nombre de nuestro archivo dentro de la carppeta storage/images, en nuestra BD
                $image->image_path = $image_path_name;
            }

            //INSERT del SQL
            $image->save();

            return redirect()->route('home')->with([
                'message'=>'La foto ha sido subida correctamente'
            ]);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file,200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail',[
            'image' => $image
        ]);
    }

    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id',$id)->get();
        $likes = Like::where('image_id',$id)->get();

        if($user && $image && $image->user->id == $user->id){
            //Eliminar comentarios
            if($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            //Eliminar likes
            if($likes && count($likes) >= 1){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //Eliminar fichero asociado a la imagen
            Storage::disk('images')->delete($image->image_path);

            //Elimina registro de la imagen
            $image->delete();

            $message = array('message' => 'La imagen se ha borrado correctamente');

        }else{
            $message = array('message' => 'La imagen no se ha borrado');
        }
            return redirect()->route('home')->with($message);
    }

    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id){
            return view('image.edit',[
                'image' => $image
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        // Validación
        $validate = $this->validate($request, [
            /* 'image_path' => 'required|mimes:jpg,jpeg,png,gif', */ //esto es igual a poner image
            'image_path' => 'required|image'
         ]);

         // Recoger datos
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Conseguir objeto image
        $image = Image::find($image_id);
        $image->description = $description;

        //Sufir fichero
        if($image_path){
            $image_path_name = time() . $image_path->getClientOriginalName();
            //Meto la imagen que se encuentra en el archivo temporal creado justo después de enviar los datos por
            //el formulario, y con el método get de la clase File lo sacamos de ahí y lo metemos en la carpeta
            //images de storage
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            //guaradmos el mismo nombre de nuestro archivo dentro de la carppeta storage/images, en nuestra BD
            $image->image_path = $image_path_name;
        }

        // Actualizar registro
        $image->update();

        return redirect()->route('image.detail',['id' => $image_id])
                            ->with(['message' => 'Imagen actualizada con éxito']);
    }
}
