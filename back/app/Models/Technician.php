<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technician extends Model
{
    use SoftDeletes;
    //
    protected $with = [ 'company'];
    protected  $appends = ['full_name'];
    protected $fillable = ['first_name', 'last_name', 'company_id'];

    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }

    public function account() {
        return $this->morphOne(Account::class, 'role');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function interventions() {
        return $this->hasMany(Intervention::class);
    }
}
