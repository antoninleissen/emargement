<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'first_name', 'last_name', 'company_name', 'address', 'complement', 'cp', 'city', 'country', 'phone'
    ];

    protected $appends = [ 'full_name', 'account_id' ];

    public function getAccountIdAttribute() {
         $result = DB::table('accounts')
             ->select('id')
             ->where('role_id', $this->id)
             ->where('role_type', self::class)
             ->first();

         if (empty($result)) {
             return null;
         }
         return $result->id;
    }

    public function account() {
        return $this->morphOne(Account::class, 'role');
    }

    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name.(empty($this->company_name) ? '' : ' ('.$this->company_name.')');
    }
}
