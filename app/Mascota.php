<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
     protected $fillable = [
        'user_id', 
        'hogar_id', 
        'foto', 
        'nombre',
        'descripcion',
    ];

    public function hogar()
    {
        return $this->belongsTo(Hogar::class , 'hogar_id');
    } 
}
