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
        Permission::create(['name' => 'Crear ventas']);//1
        Permission::create(['name' => 'Listar ventas']);//2
        Permission::create(['name' => 'Actualizar ventas']);//3
        Permission::create(['name' => 'Eliminar ventas']);//4

        Permission::create(['name' => 'Ver dashboard']);//5
        
        Permission::create(['name' => 'Crear role']);//6
        Permission::create(['name' => 'Listar role']);//7
        Permission::create(['name' => 'Editar role']);//8
        Permission::create(['name' => 'Eliminar role']);//9
        
        Permission::create(['name' => 'Listar usuarios']);//10
        Permission::create(['name' => 'Editar usuarios']);//11
        Permission::create(['name' => 'Crear usuarios']);//12
        Permission::create(['name' => 'Eliminar usuarios']);//13

        Permission::create(['name' => 'Listar personal']);//14
        Permission::create(['name' => 'Editar personal']);//15
        Permission::create(['name' => 'Crear personal']);//16
        Permission::create(['name' => 'Eliminar personal']);//17

        Permission::create(['name' => 'Listar bitacora']);//18
        Permission::create(['name' => 'Administrar usuarios']);//19
    }
}
