<?php

namespace App\Models;

use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['author','title','theme','image','content'];

    protected $casts = [
        'author' => SafeCast::class,
        'title' => SafeCast::class,
        'theme' => SafeCast::class,
        'image' => SafeCast::class,
        'content' => SafeCast::class,
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
