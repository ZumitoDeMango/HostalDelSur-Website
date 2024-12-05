<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            'nombre' => 'Single'
        ]);
        DB::table('types')->insert([
            'nombre' => 'Twin'
        ]);
        DB::table('types')->insert([
            'nombre' => 'Doble'
        ]);
        DB::table('types')->insert([
            'nombre' => 'Triple'
        ]);
        DB::table('types')->insert([
            'nombre' => 'Cuadruple'
        ]);
    }
}
