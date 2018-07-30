<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPicture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'order_id', 
        'picture',  
     ];

     public function order()
     {
         return $this->belongsTo(Order::class);
     }
}
