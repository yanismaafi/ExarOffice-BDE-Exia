<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','product_id'];


    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
