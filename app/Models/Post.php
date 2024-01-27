<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //definimos la clave primaria
    protected $primaryKey = 'post_id';
    public function comments()
    {
        //definimos la relacion con la tabla post
        return $this->hasMany(Comments::class, 'post_id');
    }
}
