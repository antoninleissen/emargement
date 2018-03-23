<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 23/03/18
 * Time: 13:57
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $casts = [
        'id'        => 'int'
    ];

    protected $fillable = ['name','firstame'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
