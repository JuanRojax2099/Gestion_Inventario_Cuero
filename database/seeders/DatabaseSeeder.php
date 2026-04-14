<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function insumorun()
{
    $this->call(InsumoSeeder::class);
}
   public function entregasrun()
{
    $this->call(entregaseed::class);
}
   public function facturaDrun()
{
    $this->call(facturaDetallesSeeder::class);
}
   public function facturarun()
{
    $this->call(facturaSeeder::class);
}
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
