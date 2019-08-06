<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legal extends Model
{
    protected $fillable = [
        'nombre', 
        'slug', 
        'texto'
    ];

    public static function descripcion()
    {
    	$query = Legal::where('slug' , 'descripcion-del-sitio')->first();
    	$out = $query->texto;

    	return $out;
    }

    public static function contacto()
    {
    	$query = Legal::where('slug' , 'contacto')->first();
    	$out = $query->texto;

    	return $out;
    }

    public static function direccion()
    {
        $query = Legal::where('slug' , 'direccion')->first();
        $out = $query->texto;

        return $out;
    }

    public static function telefono()
    {
        $query = Legal::where('slug' , 'telefono')->first();
        $out = $query->texto;

        return $out;
    }

    public static function email()
    {
        $query = Legal::where('slug' , 'email')->first();
        $out = $query->texto;

        return $out;
    }

    public static function valorDelClic()
    {
        $query = Legal::where('slug' , 'valor-del-clic')->first();
        $out = $query->valor;

        return $out;
    }
}
