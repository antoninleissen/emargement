<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 20/03/18
 * Time: 10:22
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $casts = [
        'id'        => 'int'
    ];

    protected $fillable = ['name', 'school'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
