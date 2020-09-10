<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /* Si la tabla en la BD se llamara distinto, sete se cambiaría con esta línea de código */
    protected $table = 'images';

    //Relación One To Many / de uno a muchos
    /* Este método interactua con la otra entidad de Comentarios para
    sacarlos todos y devolverlos */
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    //Relación One To Many / de uno a muchos
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //Relación Many to One
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
