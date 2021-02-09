<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    //devo stabilire la connessione tra post e postinformation 1:1

    public function postInformation(){
        //colleg. tabella principale a secondaria
        //posso specificare in hasOne il nome dell aforeign key nella tabella secondaria
        // hasOne('App\PostInformation','post_id','id'); sarebbe il comando completo
        return $this->hasOne('App\PostInformation');//class restituisce in formato stringa
    }

    public function category(){

        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
    }
}
