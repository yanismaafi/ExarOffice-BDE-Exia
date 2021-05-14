<?php

namespace App\Models;

use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','product_id'];

    protected $casts = [
       'name' => SafeCast::class,
       'slug' => SafeCast::class,
    ];


    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
