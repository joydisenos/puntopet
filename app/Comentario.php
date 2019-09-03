<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'comentario', 
        'puntos',
        'user_id',
        'negocio_id',
        'orden_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class , 'user_id');
    }

}
