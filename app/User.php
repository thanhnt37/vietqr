<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'phone', 'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function guaranteeServices()
    {
        return $this->morphedByMany(GuaranteeService::class, 'serviceable');
    }

    public function hasGuaranteeService()
    {
        return $this->guaranteeServices()->exists();
    }

    public function getDisplayName()
    {
        $url = asset('images/avatar-default.png');

        return $url;
    }
}
