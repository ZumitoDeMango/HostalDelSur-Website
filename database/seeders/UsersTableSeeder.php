<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Test 3',
            'email' => 'admin3@example.com',
            'password' => Hash::make('password'), // Cifrado de la contraseña
            'level' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Test 2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'), // Cifrado de la contraseña
            'level' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Test 1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password'), // Cifrado de la contraseña
            'level' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
