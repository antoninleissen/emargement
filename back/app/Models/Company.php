<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'name', 'address', 'complement', 'cp', 'city', 'country', 'phone'
    ];

    public function account() {
        return $this->morphOne(Account::class, 'role');
    }

    public function technicians() {
        return $this->hasMany(Technician::class);
    }

    public function maintenances() {
        return $this->hasMany(Maintenance::class);
    }
}
