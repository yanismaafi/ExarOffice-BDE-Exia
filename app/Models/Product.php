<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[ 'title', 'slug', 'subtitle', 'stock', 'price', 'category_id', 'image', 'description'];
    
    protected $casts = [
        'title' => SafeCast::class,
        'slug' => SafeCast::class,
        'subtitle' => SafeCast::class,
        'stock' => SafeCast::class,
        'price' => SafeCast::class,
        'image' => SafeCast::class,
        'description' => SafeCast::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
