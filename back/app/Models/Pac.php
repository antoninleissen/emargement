<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pac extends Model
{
    use SoftDeletes;
    //
    protected $with = ['maintenances', 'interventions'];
    protected $appends = ['owner', 'building_owner', 'user'];
    protected $fillable = [
        'serial_number', 'owner_id', 'building_owner_id', 'user_id', 'starting_at'
    ];

    public function maintenances() {
        return $this->hasMany(Maintenance::class);
    }

    public function interventions() {
        return $this->hasMany(Intervention::class);
    }

    public function tokens() {
        return $this->hasMany(Token::class);
    }

    public function owners() {
        return $this->hasMany(PacOwner::class);
    }

    private function getSpecificOwnerFromType($type) {
        $owners = $this->owners;

        foreach ($owners as $owner) {
            if ($owner->type === $type) {
                return $owner->account;
            }
        }

        return null;
    }

    public function getBuildingOwnerAttribute() {
        return $this->getSpecificOwnerFromType('building_owner');
    }

    public function getOwnerAttribute() {
        return $this->getSpecificOwnerFromType('owner');
    }

    public function getUserAttribute() {
        return $this->getSpecificOwnerFromType('user');
    }

    public function getBuildingOwnerIdAttribute() {
        return $this->building_owner->account_id;
    }

    public function setBuildingOwnerIdAttribute($account_id) {
        $pacOwner = PacOwner::firstOrNew([
            'pac_id' => $this->id,
            'type_id' => PacOwner::PAC_OWNER_BUILDING_OWNER
        ]);

        $pacOwner->account_id = $account_id;
        $pacOwner->save();
    }

    public function getOwnerIdAttribute() {
        return $this->owner->account_id;
    }

    public function setOwnerIdAttribute($account_id) {
        $pacOwner = PacOwner::firstOrNew([
            'pac_id' => $this->id,
            'type_id' => PacOwner::PAC_OWNER_OWNER
        ]);

        $pacOwner->account_id = $account_id;
        $pacOwner->save();
    }

    public function getUserIdAttribute() {
        return $this->user->account_id;
    }

    public function setUserIdAttribute($account_id) {
        $pacOwner = PacOwner::firstOrNew([
            'pac_id' => $this->id,
            'type_id' => PacOwner::PAC_OWNER_USER
        ]);

        $pacOwner->account_id = $account_id;
        $pacOwner->save();
    }
}
