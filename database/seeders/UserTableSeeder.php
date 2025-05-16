<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create multiple Users
        DB::table('user')->insert([
            'username' => 'user1@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('user')->insert([
            'username' => 'user2@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('user')->insert([
            'username' => 'user3@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);


    }
}
