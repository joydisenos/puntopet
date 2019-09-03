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
        'clase_id',
        'ciudad_id',
        'comuna_id',
        'email',
        'contacto',
        'latitud',
        'longitud',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'googleplus',
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
                    ->where('destacado' , 1)
                    ->orderByRaw('RAND()')
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

    public function comentarios()
    {
        return $this->hasMany(Comentario::class , 'negocio_id')->orderBy('id' , 'DESC');
    }

    public function getComentarios()
    {
        return Comentario::where('negocio_id' , $this->id )->orderBy('id' , 'DESC')->paginate(5);
    }

    public function verEstadisticas()
    {
        $total = $this->comentarios->count();

        $excelente = $this->comentarios->where('puntos' , 5)->count();
        $muyBueno = $this->comentarios->where('puntos' , 4)->count();
        $bueno = $this->comentarios->where('puntos' , 3)->count();
        $regular = $this->comentarios->where('puntos' , 2)->count();
        $malo = $this->comentarios->where('puntos' , 1)->count();

        $data = new \stdClass();
        $data->excelente = $total > 0 ? ($excelente * 100) / $total : 0;
        $data->muybueno = $total > 0 ? ($muyBueno * 100) / $total : 0;
        $data->bueno = $total > 0 ? ($bueno * 100) / $total : 0;
        $data->regular = $total > 0 ? ($regular * 100) / $total : 0;
        $data->malo = $total > 0 ? ($malo * 100) / $total : 0;
        $data->total = $total;
        $data->promedio = $this->comentarios->avg('puntos');

        return $data;
    }
}
