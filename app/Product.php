<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[ 'title', 'slug', 'subtitle', 'stock', 'price', 'category_id', 'image', 'description'];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
