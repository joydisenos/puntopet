<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'user_id', 
        'negocio_id', 
        'foto', 
        'precio', 
        'nombre',
        'descripcion',
    ];

    public function negocio()
    {
    	return $this->belongsTo(Negocio::class , 'negocio_id');
    }

    public function productosHome()
    {
        return $this->orderByRaw('RAND()')
                    ->take(12)
                    ->get();
    }

    public function productos()
    {
        return $this->where('estatus' , 1)
                    ->get();
    }

     public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function ventas()
    {
        return $this->hasMany(Compra::class , 'producto_id');
    }

    public function estatusProducto($int)
    {
        switch ($int) {
            case 1:
                $estatus = "Activo";
                break;

            case 0:
                $estatus = "Inactivo";
                break;
            
            default:
                $estatus = "No definido";
                break;
        }

        return $estatus;
    }
}
