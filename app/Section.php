<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;

class Section extends Model
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
        'description', 
        'icon', 
     ];

     public function Categories()
     {
         return $this->hasMany(Category::class);
     }

     
}
