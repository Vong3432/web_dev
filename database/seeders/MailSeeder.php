<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mail;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mail::create([
            'name' => 'Blog 1',            
            'content' => 'lorem ipsum'            
        ]);
    }
}
