<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 19/03/18
 * Time: 15:09
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $casts = [
        'id'        => 'int'
    ];

    protected $fillable = ['name', 'speaker'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
