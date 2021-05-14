<?php

namespace App\Models;

use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['lname','fname','email','subject','message'];

    protected $casts = [
        'lname' => SafeCast::class,
        'fname' => SafeCast::class,
        'email' => SafeCast::class,
        'subject' => SafeCast::class,
        'message' => SafeCast::class,
    ];
}
