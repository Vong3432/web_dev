<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    /* 
    @@ What is fillable?
    - Values in fillable can be set when we create Model        
    
    @@ Example: 
    $order = new Order([
        'user_id' => 123
    ]);
    */
    protected $fillable = [
        'user_id', 'stripe_order_id'
    ];    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products() 
    {
        return $this->belongsToMany(Products::class, "orders_products", "order_id", "product_id");
    }
    
    
}
