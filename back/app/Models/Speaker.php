<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 20/03/18
 * Time: 09:39
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $casts = [
        'id'        => 'int'
    ];

    protected $fillable = ['name'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
