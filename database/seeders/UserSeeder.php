<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'username' => 'admin',
            'email' => 'testadmin@gmail.com',
            'password' => Hash::make('admin123456'),
            'is_admin' => true,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::insert([
            'username' => 'admin2',
            'email' => 'testadmin2@gmail.com',
            'password' => Hash::make('admin123456'),
            'is_admin' => true,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        User::factory()
            ->count(100)
            ->create();
    }
}
