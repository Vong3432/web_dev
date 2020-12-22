<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'desc',
        'price',
        'sprice',
        'quantity',
        'weight',
        'status',
        'category_id',
        'tags',
        'discount_rate',
    ];


    

    public function images(){
        return $this->hasMany(ProductsImages::class);
    }

    

    
}
