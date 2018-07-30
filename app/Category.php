<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Section;
use App\Order;

class Category extends Model
{

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name', 
        'section_id',  
     ];

    public function category()
    {
        return $this->belongsTo(Section::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
