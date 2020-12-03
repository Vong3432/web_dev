<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /* 
    @@ What is fillable?
    - Values in fillable can be set when we create Model        
    
    @@ Example: 
    $order = new Order([
        'user_id' => 123
    ]);
    */
    protected $fillable = [
        'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Products');
    }
}
