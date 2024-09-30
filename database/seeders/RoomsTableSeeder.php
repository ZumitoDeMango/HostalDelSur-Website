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
        DB::table('rooms')->insert([
            'nombre' => 'Habitacion 1',
            'tipo' => 'Matrimonial',
            'precio' => 40000,
            'banopriv' => True,
            'television' => True,
            'aireac' => True,
            'descripcion' => 'Acogedora habitacion',
            'piso' => 1,
            'disponible' => True
        ]);
        DB::table('rooms')->insert([
            'nombre' => 'Habitacion 2',
            'tipo' => 'Single',
            'precio' => 20000,
            'banopriv' => true,
            'television' => true,
            'aireac' => true,
            'descripcion' => 'Hermosa habitacion',
            'piso' => 2,
            'disponible' => false
        ]);
    }
}
