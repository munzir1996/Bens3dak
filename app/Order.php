<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\Adviser;
use App\AdviserPicture;
use App\UserPicture;

class Order extends Model
{
    
    const CONFIRMED = '1';
    const UNCONFIRMED = '0';

    protected $fillable = [
        'notes', 
        'location', 
        'confirmation',
        'adviser_notes',
        'cost',
        'adviser_id',
        'user_id',
        'category_id', 
     ];

     public function adviser()
     {
         return $this->belongsTo(Adviser::class);
     }

     public function user()
     {
         return $this->belongsTo(User::class);
     }

     public function category()
     {
         return $this->belongsTo(Category::class);
     }

     public function adviserPictures()
     {
         return $this->hasMany(AdviserPicture::class);
     }
     public function userPictures()
     {
         return $this->hasMany(UserPicture::class);
     }

}
