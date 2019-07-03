<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hogar extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'slug',
        'descripcion',
        'direccion',
        'logo_local',
        'foto_local',
    ];

    public function hogares()
    {
    	return $this->where('nombre' , '!=' , null)
    				->where('descripcion' , '!=' , null)
    				->where('estatus' , 1)
    				->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class );
    }
}
