<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'apellido' , 
        'email', 
        'telefono', 
        'nombre_negocio', 
        'direccion', 
        'ciudad', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    public function getIsAdminAttribute()
    {
        return true;
    }
    */

    public function productos()
    {
        return $this->hasMany(Producto::class , 'user_id');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'user_id');
    }

    public function favoritosHogar()
    {
        return $this->hasMany(Favorito::class , 'user_id')
                    ->where('hogar_id' , '!=' , null);
    }

    public function favoritosTienda()
    {
        return $this->hasMany(Favorito::class , 'user_id')
                    ->where('negocio_id' , '!=' , null);
    }

    public function compras()
    {
        return $this->hasMany(Orden::class , 'user_id');
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class , 'user_id');
    }

    public function negocios()
    {
        return $this->hasMany(Negocio::class , 'user_id');
    }

    public function hogares()
    {
        return $this->hasMany(Hogar::class , 'user_id');
    }

    public function mascotas()
    {
        return $this->hasMany(Mascota::class , 'user_id');
    }

    public function esFavoritoTienda($negocio_id)
    {
        $esFavorito = $this->whereHas('favoritos' , function($q) 
                                                    use($negocio_id)
                        {
                            $q->where('negocio_id' , $negocio_id);
                        })->first();

        return $esFavorito;
    }

    public function esFavoritoHogar($hogar_id)
    {
        $esFavorito = $this->whereHas('favoritos' , function($q) 
                                                    use($hogar_id)
                        {
                            $q->where('hogar_id' , $hogar_id);
                        })->first();

        return $esFavorito;
    }
}
