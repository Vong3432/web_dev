<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => "user@user.com",
            'password' => Hash::make("password"),                
        ]);

        User::create([
            'name' => 'Admin',
            'email' => "admin@admin.com",
            'password' => Hash::make("password"),                                                
            'email_verified_at' => '2020',
            'level' => 'admin'
        ]);
    }
}
