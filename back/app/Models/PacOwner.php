<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacOwner extends Model
{
    const PAC_OWNER_OWNER = 1;
    const PAC_OWNER_BUILDING_OWNER = 2;
    const PAC_OWNER_USER = 3;
    //
    protected $with = ['account'];
    protected $fillable = ['pac_id', 'type_id', 'account_id'];

    public function pac() {
        return $this->belongsTo(Pac::class);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function getTypeAttribute() {
        switch ($this->type_id) {
            case self::PAC_OWNER_OWNER:
                return 'owner';
                break;
            case self::PAC_OWNER_BUILDING_OWNER:
                return 'building_owner';
                break;
            case self::PAC_OWNER_USER:
                return 'user';
                break;
        }

        return 'unknown';
    }
}
