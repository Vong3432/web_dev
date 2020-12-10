<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    use HasFactory;

    protected $table = 'products_images';

    protected $fillable = [
        'product_id'
    ];

    public function productImgs()
    {
        return $this->belongsToMany('App\Models\ProductsImages');
    }
}
