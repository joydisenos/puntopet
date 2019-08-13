<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    public static function comunas()
    {
    	return Comuna::where('estatus' , 1)->get();
    }
}
