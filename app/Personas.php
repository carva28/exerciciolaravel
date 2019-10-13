<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personas extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name_persona','description','movie_id'
    ];

    public function movies(){
        return $this->belongsTo('App\Movies','movie_id'); //o campo user id pertence ao App user, no segundo parametro especifica-se a chave
        
    }
}
