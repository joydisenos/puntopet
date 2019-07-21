<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class Hogar extends Model
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

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function visitas()
    {
        $track = Tracker::logByRouteName('ver.hogar')
                        ->where(function($query)
                        {
                            $query->where('parameter', 'slug')
                                    ->where('value', $this->slug)
                                    ->whereRaw('Month(tracker_log.created_at) = '. date('m'))
                                    ->whereRaw('Year(tracker_log.created_at) = '. date('Y'));
                        })->count();

        return $track;
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}
