<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Must follow orders
        $this->call(UsersSeeder::class);
        // $this->call(ProductCategorySeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ProductImagesSeeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(OrderProductSeeder::class);
        $this->call(MailSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(TestsTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
    }
}
