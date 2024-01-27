<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    //indicamos cual es la clave principal
    protected $primaryKey = 'comments_id';
    //especificamos los atributos que pueden ser llenados de forma masiva
    protected $fillable = [
        'users_id',
        'post_id',
        'contenido',
    ];
    public function post()
    {
        //definimos la relacion foranea
        return $this->belongsTo(Post::class, 'post_id');
    }
}
