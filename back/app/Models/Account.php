<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'role_type'
    ];

    protected $with = ['role'];
    protected $appends = ['type'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->morphTo('role');
    }

    public function getTypeAttribute() {
        switch($this->attributes['role_type']) {
            case Customer::class:
                return 'customer';
                break;
            case Technician::class:
                return 'technician';
                break;
            case Company::class:
                return 'sta';
                break;
            case Admin::class:
                return 'admin';
                break;
            default:
                return 'unknown';
                break;
        }

    }
}
