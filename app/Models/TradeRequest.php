<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeRequest extends Model
{
    use HasFactory;
    protected $table = 'trade_requests';

    protected $fillable = [
        'order_id', 'status', 'description', 'user_id'
    ];  

    public function order() 
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
