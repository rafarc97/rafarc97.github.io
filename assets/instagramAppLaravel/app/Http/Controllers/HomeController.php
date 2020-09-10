<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* Este middleware se encuentra en Kernel.php, en la variable protected $routeMiddleware */
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Con paginate conseguimos que se paginen de 5 en 5
        $images = Image::orderBy('id','desc')->paginate(5);
        return view('home',[
            'images' => $images
        ]);
    }
}
