<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'first_name', 'last_name'
    ];

    public function account() {
        return $this->morphOne(Account::class, 'role');
    }
}
