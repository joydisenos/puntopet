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

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function mascotasHome()
    {
        return $this->orderby('created_at' , 'ASC')
                    ->take(12)
                    ->get();
    }

    public function mascotas()
    {
        return $this->where('estatus' , 1)
                    ->get();
    }
}
