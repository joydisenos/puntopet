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

    public function negocio()
    {
        return $this->belongsTo(Negocio::class , 'negocio_id');
    }

    public function verEstatus($estatus)
    {
        switch ($estatus) {
            case 1:
                $estatus = "Pendiente";
                break;

            case 2:
                $estatus = "Enviado/Entregado";
                break;

            case 0:
                $estatus = "Rechazado";
                break;
            
            default:
                $estatus = "No definido";
                break;
        }
        return $estatus;
    }
}
