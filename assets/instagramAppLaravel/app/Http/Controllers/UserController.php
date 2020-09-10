<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage; //para la subida de imágenes
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{

    /* De esta manera evitamos que se pueda acceder a la configuracion de un usuario
    sin previamente haberse logeado*/
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null){
        if(!empty($search)){
            $users = User::where('nick','LIKE','%'.$search.'%')
                            ->orWhere('name','LIKE','%'.$search.'%')
                            ->orWhere('surname','LIKE','%'.$search.'%')
                            ->orderBy('id','desc')
                            ->paginate(5);
        }else{
            $users = User::orderBy('id','desc')->paginate(5);
        }
        return view('user.index',[
            'users' => $users
        ]);
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        //Conseguir usuario identificado
        $user = \Auth::user(); //metemos en $user un objeto de tipo usuario de nuestro modelo de laravel
        $id = \Auth::user()->id;


        // VALIDACIÓN
        // Estas son las mismas reglas de validación que tenemos en RegisterController.php
        //De esta forma nos estamos ahorrando tener que ahacer las comprobaciones con la base
        //de datos, esta es una forma mucho más sencilla
        $validate = $this->validate($request, ['name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            //Comprueba que el campo es único y que además que ese nick coincide con el $id que recibimos
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,' . $id ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id]
        ]);

        // RECOGER DATOS DEL FORMULARIO
        //Le ponemos la barra delantea Auth pq no hay ningún namespace indicado y puede fallar
        $id = \Auth::user()->id;
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //Subir la imagen
        //al ser una imagen se recoge con file en lugar de con input
        $image_path = $request->file('image_path');
        if($image_path){
            //Le damos un nombre único
            $image_path_name = time() . $image_path->getClientOriginalName();
            //Copiamos la iamgen de la carpeta temporal donde se ha guardado tras hacer el post
            //a la carpeta de users dentro del storage
            Storage::disk('users')->put($image_path_name,File::get($image_path));

            $user->image = $image_path_name;
        }

        //Actualización nuevos valores usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $user->update();

        return redirect()->route('config')
                        ->with(['message'=>'Usuario Actualizado correctamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200); //Codigo 200 (correcto)
    }

    public function profile($id){
        $user = User::find($id);

        return view('user.profile',[
            'user' => $user
        ]);
    }
}
