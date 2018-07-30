<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;

class Adviser extends Model
{
    use Notifiable, SoftDeletes;


    const VERIFIED = '1';
    const UNVERIFIED = '0';

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

        public static function generateVerificationCode()
        {
            return str_random(40);
        }

        public static function generateApiToken()
        {
            return bin2hex(openssl_random_pseudo_bytes(30));
        }

        public function orders()
        {
            return $this->hasMany(Order::class);
        }

}
