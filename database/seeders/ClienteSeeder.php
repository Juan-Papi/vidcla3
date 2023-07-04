<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Telefono;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Este seeder creará 10 clientes, cada uno con 1 a 3 teléfonos.
         Cliente::factory(10)->create()->each(function ($cliente) {
            $cliente->telefonos()->saveMany(Telefono::factory(rand(1, 3))->make());
        });
    }
}
