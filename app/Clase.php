<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = [
        'nombre', 
        'slug'
    ];

    public function tiendas()
    {
    	return $this->hasMany(Negocio::class);
    }

    public static function clases()
    {
    	return Clase::whereHas('tiendas')->get();
    }
}
