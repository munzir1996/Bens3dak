<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Rate extends Model
{
    const UNRATED = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 
        'rate', 
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
