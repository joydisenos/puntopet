<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public static function ciudades()
    {
    	return Ciudad::where('estatus' , 1)->get();
    }
}
