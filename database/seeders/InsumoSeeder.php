<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         db::table('insumos')->insert(
            [
                'name' => 'Insumoprueba1',
                'unidad' => 'unidad1',
                'cantidad' => 100,
                'categoria' => 'materiaprima',
                'proveedor' => 'Proveedora1'
            ]);
    }
}
