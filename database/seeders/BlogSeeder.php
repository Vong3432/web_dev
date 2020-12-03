<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blogs;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blogs::create([
            'title' => 'Blog 1',            
            'content' => 'lorem ipsum',
            'tags' => 'lifestyle, sport'
        ]);
    }
}
