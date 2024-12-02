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
        DB::table('rooms')->insert([
            'nombre' => 'Habitacion 1',
            'tipo' => 3,
            'precio' => 40000,
            'banopriv' => True,
            'television' => True,
            'aireac' => True,
            'descripcion' => 'Acogedora habitacion',
            'piso' => 1,
            'disponible' => True,
            'urlfoto' => 'I II II I_'
        ]);
        DB::table('rooms')->insert([
            'nombre' => 'Habitacion 2',
            'tipo' => 1,
            'precio' => 20000,
            'banopriv' => true,
            'television' => true,
            'aireac' => true,
            'descripcion' => 'Hermosa habitacion',
            'piso' => 2,
            'disponible' => false,
            'urlfoto' => 'I II II I_'
        ]);
    }
}
