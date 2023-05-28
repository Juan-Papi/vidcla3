<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'Crear pedidos']);
        Permission::create(['name' => 'Listar pedidos']);
        Permission::create(['name' => 'Actualizar pedidos']);
        Permission::create(['name' => 'Eliminar pedidos']);

        Permission::create(['name' => 'Ver dashboard']);
        
        Permission::create(['name' => 'Crear role']);
        Permission::create(['name' => 'Listar role']);
        Permission::create(['name' => 'Editar role']);
        Permission::create(['name' => 'Eliminar role']);
        
        Permission::create(['name' => 'Listar usuarios']);
        Permission::create(['name' => 'Editar usuarios']);

    }
}
