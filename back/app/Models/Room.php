<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $casts = [
        'id'        => 'int'
    ];

    protected $fillable = ['name'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
