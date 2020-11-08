<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestModel;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TestModel::create([
            'name' => 'Test 1'
        ]);
        
    }
}
