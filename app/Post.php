<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['author','title','theme','image','content'];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
