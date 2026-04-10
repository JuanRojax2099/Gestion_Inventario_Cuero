<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class entregaseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     db::table('entregas')->insert(
            [
                'factura_id' => 1,
                'fecha' => now(),
                'cliente' => 'Clienteprueba1',
            ]);
    }
}
