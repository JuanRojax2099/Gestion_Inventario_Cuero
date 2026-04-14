<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class facturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         db::table('factura')->insert(
            [
                'detalles' => 'kkkk',
                'proveedor' => 1,
                'fecha' => now(),
                
            ]);
    }
}
