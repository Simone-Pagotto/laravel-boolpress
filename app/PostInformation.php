<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostInformation extends Model
{
    //
    protected $table = 'posts_information';

    public function post(){
        //essendo la secondaria non uso hasOne, ma una funzione che mi illustra il riferimento
        return $this->belongsTo('App\Post');
    }
}
