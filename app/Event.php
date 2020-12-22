<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = ['name','slug','date','nbrPlaces','description','image'];


    public function users()
    {
        return $this->belongsToMany('App\User','registration','user_id','event_id');
    }
}
