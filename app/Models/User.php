<?php

namespace App\Models;

use App\Casts\SafeCast;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => SafeCast::class,
        'email' => SafeCast::class,
        'subtitle' => SafeCast::class,
        'password' => SafeCast::class,
        'role' => SafeCast::class,
        'email_verified_at' => 'datetime',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function events()
    {
        return $this->belongsToMany('App\Event','registration','user_id','event_id');
    }


    public function isAdmin()
    {
        if($this->role == 'Admin')
        {
            return true;
        }
        
        return false;
    }
}
