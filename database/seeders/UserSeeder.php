<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com', 
            'user_type' => '1',    
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'name' => 'Customer',
            'email' => 'customer@gmail.com', 
            'user_type' => '2',    
            'password' => Hash::make('12345678'),
        ]);
    }
}
