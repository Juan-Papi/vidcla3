<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Administrador']);
        $role->permissions()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

        //Otra forma de agregar permisos con nombres
        $role = Role::create(['name' => 'Ejecutivo de ventas']);
        $role->syncPermissions(['Crear ventas', 'Listar ventas']);
    }
}
