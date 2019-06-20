<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'slug',
        'descripcion',
        'direccion',
        'foto_local',
    ];

    public function tiendas()
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

    public function productos()
    {
        return $this->hasMany(Producto::class );
    }

    public function ventas()
    {
        return $this->hasMany(Orden::class , 'negocio_id');
    }
}
