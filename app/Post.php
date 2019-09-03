<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	 protected $fillable = [
        'user_id',
        'post_id',
        'imagen',
        'palabras_clave',
        'titulo',
        'slug',
        'mensaje',
      
    ];
    public function posts()
    {
    	$posts = $this->where('estatus' , 1 )
                        ->where('post_id' , null)
                        ->orderBy('id' , 'DESC')->get();

    	return $posts;
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Post::class , 'post_id')->orderBy('id' , 'DESC');
    }

    public function siguientePost()
    {
        return $this->where('id' , '>' , $this->id )
                        ->where('estatus' , 1 )
                        ->where('post_id' , null)
                        ->first();
    }

    public function anteriorPost()
    {
        return $this->where('id' , '<' , $this->id )
                        ->where('estatus' , 1 )
                        ->where('post_id' , null)
                        ->orderBy('id' , 'DESC')
                        ->first();
    }
}
