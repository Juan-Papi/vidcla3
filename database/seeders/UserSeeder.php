<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usuarios = [
            //nro 1
            [
                'name' => 'Eduardo Rojas Calderon',
                'email' => 'eduardo123sc@gmail.com',
                'password' => bcrypt('87654321')
            ],
            //nro 2
            [
                'name' => 'Antonio Quinteros',
                'email' => 'antonio123@gmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 3
            [
                'name' => 'Pepe Rosado',
                'email' => 'pepe123sc@gmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 4
            [
                'name' => 'Carlinchi Rojas',
                'email' => 'carl123@gmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 5
            [
                'name' => 'Rodrigo Murillo',
                'email' => 'murillorodri123@gmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 6
            [
                'name' => 'Rolando Perez',
                'email' => 'rolando123@gmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 7
            [
                'name' => 'María González',
                'email' => 'maria@hotmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 8
            [
                'name' => 'Rosa Vanidosa',
                'email' => 'rosaura18@hotmail.com',
                'password' => bcrypt('password123')
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::create($usuario);
        }

        //ADMINISTRADORES POR DEFECTO

        User::create([
            'name' => 'Juan Pablo Rodriguez',
            'email' => 'pablojuan123sc@gmail.com',
            'password' => bcrypt(12345678)
        ])->assignRole('Administrador');
        User::create([
            'name' => 'Carlos Benjamin Romero',
            'email' => 'carlos123sc@gmail.com',
            'password' => bcrypt(12345678)
        ])->assignRole('Administrador');
        User::create([
            'name' => 'Camilo Sarmiento',
            'email' => 'camilo123sc@gmail.com',
            'password' => bcrypt(12345678)
        ])->assignRole('Administrador');
        User::create([
            'name' => 'Alejandro Calzadilla',
            'email' => 'alejandro123sc@gmail.com',
            'password' => bcrypt(12345678)
        ])->assignRole('Administrador');

        //EJECUTIVOS DE VENTAS(VENDEDORES)

        User::create([
            'name' => 'Pedro Fernandez',
            'email' => 'pedrofer123sc@gmail.com',
            'password' => bcrypt(12345678)
        ])->assignRole('Ejecutivo de ventas');
        User::create([
            'name' => 'Diego Robles',
            'email' => 'diego123sc@gmail.com',
            'password' => bcrypt(12345678)
        ])->assignRole('Ejecutivo de ventas');
    }
}
