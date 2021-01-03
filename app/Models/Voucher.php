<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BeyondCode\Vouchers\Traits\HasVouchers;

class Voucher extends Model
{
    // use HasFactory;
    use HasVouchers;

    protected $table = 'vouchers';

    protected $fillable = [
        'model_id',
        'data',
        'expires_at'
    ];

    // Eloquent
    public function product() {
        // return $this->belongTo(Products::class, 'model_id');
        return $this->belongsTo(Products::class, 'product_id');
    }
}
