<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $fillable = [
        'user_id', 
        'negocio_id',
        'hogar_id'
    ];

    public function tienda()
    {
    	return $this->belongsTo(Negocio::class , 'negocio_id');
    }

    public function hogar()
    {
    	return $this->belongsTo(Hogar::class , 'hogar_id');
    }
}
