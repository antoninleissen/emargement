<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use SoftDeletes;
    //
    protected $with = ['company'];

    protected $fillable = [
        'pac_id',
        'company_id',
        'contract_number',
        'start_date',
        'stop_date'
    ];

    public function pac() {
        return $this->belongsTo(Pac::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
