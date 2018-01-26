<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Test extends Model
{
    protected $casts = [
        'id'        => 'int'
    ];

    protected $fillable = ['test1', 'test2'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
