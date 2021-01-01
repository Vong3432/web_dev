<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    use HasFactory;

    protected $table = 'orders_products';

    /* 
    @@ What is fillable?
    - Values in fillable can be set when we create Model        
    
    @@ Example: 
    $order = new Order([
        'user_id' => 123
    ]);
    */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }       
    
}
