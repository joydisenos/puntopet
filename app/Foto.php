<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'hogar_id',
        'negocio_id',
        'nombre',
        'ruta',
        'archivo',
    ];
}
