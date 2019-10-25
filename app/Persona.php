<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name_persona','description','movie_id'
    ];

    public function movie(){
        return $this->belongsTo('App\Movie','movie_id'); //o campo user id pertence ao App user, no segundo parametro especifica-se a chave
        
    }
}
