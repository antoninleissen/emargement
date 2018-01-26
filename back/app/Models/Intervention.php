<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use SoftDeletes;
    //
    protected $with = ['technician'];

    protected $fillable = [ 'technician_id', 'pac_id', 'installation', 'start_date', 'stop_date' ];

    public function pac() {
        return $this->belongsTo(Pac::class);
    }

    public function technician() {
        return $this->belongsTo(Technician::class);
    }
}
