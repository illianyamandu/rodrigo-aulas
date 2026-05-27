<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'number',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id')->first();
    }
}
