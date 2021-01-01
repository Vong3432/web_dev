<?php

namespace Database\Seeders;

use App\Models\OrdersProduct;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrdersProduct::create([            
            'product_id' => 1,                                    
            'order_id' => 1,                                    
        ]);
    }
}
