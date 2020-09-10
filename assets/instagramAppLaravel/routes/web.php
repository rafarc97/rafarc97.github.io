<?php

use Illuminate\Support\Facades\Route;
use App\Image; /* Para poder hacer uso del modelo Image */


/*
Route::get('/', function () {
    $images = Image::all();
    //En $images tenemos tanto los atributos de la tabla
    //como los métodos creados en el modelo

    //De esta forma nos ahorramos hacer muchos INNER JOIN y consultas más complejas
    foreach($images as $image){
        echo 'Descripción: ' . $image->description . '<br>';
        echo 'Nombre: ' . $image->user->name . ' Apellido: ' . $image->user->surname . '<br>';

        //Para sacar todos los comentarios de la imagen debemos hacer un foreach porque
        //son muchos por cada iamgen, por eso no se hace de la misma forma que con
        //el name y username
        if(count($image->comments) >= 1){
            echo '<strong>Comentarios: </strong><br>';
            foreach($image->comments as $comment){
                echo 'Nombre: ' . $comment->user->name . ' Apellido: ' . $comment->user->surname . '<br>';
                echo $comment->content . '<br>';
            }

        }
        echo 'LIKES: ' . count($image->likes);
        echo '<hr>';
    }
}); */

// GENERALES
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// USUARIO
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id}','UserController@profile')->name('profile');
Route::get('/gente/{search?}','UserController@index')->name('user.index');

// IMAGEN
Route::get('/subir-imagen','ImageController@create')->name('image.create');
Route::post('/image/save','ImageController@save')->name('image.save');
Route::get('/image/file/{filename}','ImageController@getImage')->name('image.file');
Route::get('/image/delete/{id}','ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}','ImageController@edit')->name('image.edit');
Route::post('/image/update','ImageController@update')->name('image.update');
Route::get('/imagen/{id}','ImageController@detail')->name('image.detail');

// COMENTARIOS
Route::post('/comment/save','CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}','CommentController@delete')->name('comment.delete');

// LIKES
Route::get('/like/{image_id}','LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}','LikeController@dislike')->name('like.delete');
Route::get('/likes','LikeController@index')->name('like.index');

