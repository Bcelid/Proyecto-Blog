<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $primaryKey = 'comments_id';
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
