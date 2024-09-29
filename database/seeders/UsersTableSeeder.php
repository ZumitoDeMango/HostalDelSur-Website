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
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Cifrado de la contraseña
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
