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

        Permission::create(['name' => 'Listar telefono']);//20
        Permission::create(['name' => 'Editar telefono']);//21
        Permission::create(['name' => 'Crear telefono']);//22
        Permission::create(['name' => 'Eliminar telefono']);//23

        Permission::create(['name' => 'Listar cliente']);//24
        Permission::create(['name' => 'Editar cliente']);//25
        Permission::create(['name' => 'Crear cliente']);//26
        Permission::create(['name' => 'Eliminar cliente']);//27

        Permission::create(['name' => 'Listar proveedor']);//28
        Permission::create(['name' => 'Editar proveedor']);//29
        Permission::create(['name' => 'Crear proveedor']);//30
        Permission::create(['name' => 'Eliminar proveedor']);//31

        Permission::create(['name' => 'Listar almacen']);//32
        Permission::create(['name' => 'Editar almacen']);//33
        Permission::create(['name' => 'Crear almacen']);//34
        Permission::create(['name' => 'Eliminar almacen']);//35

        Permission::create(['name' => 'Listar compras']);//36
        Permission::create(['name' => 'Editar compras']);//37
        Permission::create(['name' => 'Crear compras']);//38
        Permission::create(['name' => 'Eliminar compras']);//39

        Permission::create(['name' => 'Administrar compras']);//40
        Permission::create(['name' => 'Administrar ventas']);//41

        Permission::create(['name' => 'Administrar inventario']);//42

        Permission::create(['name' => 'Listar parabrisa']);//43
        Permission::create(['name' => 'Editar parabrisa']);//44
        Permission::create(['name' => 'Crear parabrisa']);//45
        Permission::create(['name' => 'Eliminar parabrisa']);//46

        Permission::create(['name' => 'Listar posicion']);//47
        Permission::create(['name' => 'Editar posicion']);//48
        Permission::create(['name' => 'Crear posicion']);//49
        Permission::create(['name' => 'Eliminar posicion']);//50

        Permission::create(['name' => 'Listar categoria']);//51
        Permission::create(['name' => 'Editar categoria']);//52
        Permission::create(['name' => 'Crear categoria']);//53
        Permission::create(['name' => 'Eliminar categoria']);//54

        Permission::create(['name' => 'Listar marca']);//55
        Permission::create(['name' => 'Editar marca']);//56
        Permission::create(['name' => 'Crear marca']);//57
        Permission::create(['name' => 'Eliminar marca']);//58

        Permission::create(['name' => 'Listar vehiculo']);//59
        Permission::create(['name' => 'Editar vehiculo']);//60
        Permission::create(['name' => 'Crear vehiculo']);//61
        Permission::create(['name' => 'Eliminar vehiculo']);//62

    }
}
