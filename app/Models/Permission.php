<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
    ];

    public function getUsers()
    {
        return $this->belongsToMany(User::class, 'permission_user')->get();
    }
}
