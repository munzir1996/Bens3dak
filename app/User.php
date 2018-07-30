<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Complain;
use App\Order;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const VERIFIED = '1';
    const UNVERIFIED = '0';

    const BLOCKED_USER = '1';
    const UNBLOCKED_USER = '0';

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'phone',
        'verification_token',
        'verified',
        'block',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',   
    ];

    public function isVerified()
    {
        return $this->verified == User::VERIFIED;
    }

    public function isBlocked()
    {
        return $this->block == User::BLOCKED_USER;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }

    public static function generateApiToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(30));
    }

    public function complains()
    {
        return $this->hasMany(Complain::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
