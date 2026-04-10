<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class facturaDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         db::table('factura_detalles')->insert(
            [
                'id_factura' => '1',
                'producto' => '1',
                'cantidad' => 100,
            ]);
    }
}
