<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class Negocio extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'slug',
        'descripcion',
        'telefono',
        'direccion',
        'logo_local',
        'foto_local',
        'entrega_domicilio',
        'entrega_local',
        'envio_gratis'
    ];

    public function tiendas()
    {
    	return $this->where('nombre' , '!=' , null)
    				->where('descripcion' , '!=' , null)
    				->where('estatus' , 1)
    				->get();
    }

    public function tiendasSlider()
    {
        return $this->where('nombre' , '!=' , null)
                    ->where('descripcion' , '!=' , null)
                    ->where('estatus' , 1)
                    ->orderByRaw('RAND()')
                    ->take(6)
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
        return $this->hasMany(Orden::class , 'negocio_id')->orderBy('id' , 'desc');
    }

    public function visitas()
    {
        $track = Tracker::logByRouteName('ver.tienda')
                        ->where(function($query)
                        {
                            $query->where('parameter', 'slug')
                                    ->where('value', $this->slug)
                                    ->whereRaw('Month(tracker_log.created_at) = '. date('m'))
                                    ->whereRaw('Year(tracker_log.created_at) = '. date('Y'));
                        })
                        
                        ->count();

        return $track;
    }

    public function visitasDetalle()
    {
        $track = Tracker::logByRouteName('ver.tienda')
                        ->where(function($query)
                        {
                            $query->where('parameter', 'slug')
                                    ->where('value', $this->slug)
                                    ->whereRaw('Month(tracker_log.created_at) = '. date('m'))
                                    ->whereRaw('Year(tracker_log.created_at) = '. date('Y'));
                        })
                        ->get();

        return $track;
    }
}
