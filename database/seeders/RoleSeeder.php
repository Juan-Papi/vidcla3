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
        $role->permissions()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62]);

        //Otra forma de agregar permisos con nombres
        $role = Role::create(['name' => 'Ejecutivo de ventas']);
        $role->syncPermissions(['Ver dashboard', 'Administrar ventas', 'Listar telefono', 'Editar telefono', 'Crear telefono', 'Eliminar telefono', 'Listar cliente', 'Editar cliente', 'Crear cliente', 'Listar ventas', 'Crear ventas', 'Administrar compras', 'Listar almacen']);
    }
}
