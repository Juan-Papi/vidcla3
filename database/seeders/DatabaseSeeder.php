<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        Permission::create(['name' => 'Crear pedidos']);
        Permission::create(['name' => 'Ver pedidos']);
        Permission::create(['name' => 'Actualizar pedidos']);
        Permission::create(['name' => 'Eliminar pedidos']);
    }
}
