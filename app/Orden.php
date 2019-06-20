<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
     protected $fillable = [
        'user_id', 
        'negocio_id',
        'direccion_id',
        'envio',
        'pago',
        'total',
        'estatus',
    ];

    public function productos()
    {
        return $this->hasMany(Compra::class , 'orden_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
