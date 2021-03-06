<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    
    protected $fillable = [
        'code',
        'type',
        'value',
        'percent_off'
    ];

    /* Eloquent */
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    /* public static function findByCode($code) {
        return self::where('code', $code)->first();
    }

    public function discount($total) {
        if($this->type == 'fixed') {
            return $this->value;
        }elseif($this->type == 'percent') {
            return ($this->percent_off / 100) * total;
        } else {
            return 0;
        }
    } */
}