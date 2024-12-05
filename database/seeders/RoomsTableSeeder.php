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
            'urlfoto' => json_encode(['hab1.jpeg'])
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
            'urlfoto' => json_encode(['hab1.jpeg'])
        ]);
        DB::table('rooms')->insert([
            'nombre' => 'Habitación 3',
            'tipo' => 2,
            'precio' => 25000,
            'banopriv' => false,
            'television' => true,
            'aireac' => false,
            'descripcion' => 'Habitación sencilla con vistas al jardín.',
            'piso' => 1,
            'disponible' => true,
            'urlfoto' => json_encode(['hab1.jpeg'])
        ]);
    }
}
