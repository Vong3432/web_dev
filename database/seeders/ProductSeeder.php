<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([
            'name' => 'Product 1',
            'desc' => "Desc",
            'quantity' => 1,
            'price' => 20.00,
            'tags' => "Tag 1, Tag 2",
            'discount_rate' => 0.2,
            'category_id' => 1,
        ]);

        Products::create([
            'name' => 'Product 2',
            'desc' => "Desc",
            'quantity' => 1,
            'price' => 20.00,
            'tags' => "Tag 1, Tag 2",
            'discount_rate' => 0.2,
            'category_id' => 1,
        ]);
    }
}
