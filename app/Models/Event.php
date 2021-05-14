<?php

namespace App\Models;

use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = ['name','slug','date','nbrPlaces','description','image'];

    protected $casts = [
        'name' => SafeCast::class,
        'slug' => SafeCast::class,
        'date' => SafeCast::class,
        'nbrPlaces' => SafeCast::class,
        'description' => SafeCast::class,
        'image' => SafeCast::class,
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','registration','user_id','event_id');
    }
}
