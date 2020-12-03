<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsImages;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductsImages::create([
            'name' => 'link',            
            'product_id' => '1',  
        ]);
    }
}
