<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'image',
        'name',
        'time',
        'date',
        'location',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
