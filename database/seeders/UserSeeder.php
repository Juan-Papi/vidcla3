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
        User::create([
            'name'=>'Juan Pablo Rodriguez',
            'email'=>'pablojuan123sc@gmail.com',
            'password'=>bcrypt(12345678)
        ]);
        $usuarios = [
            //nro 1
            [
                'name' => 'Eduardo Rojas Calderon',
                'email' => 'calderoneduardo123sc@gmail.com',
                'password' => bcrypt('87654321')
            ],
            //nro 2
            [
                'name' => 'Alejandro',
                'email' => 'alejandrol123@gmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 3
            [
                'name' => 'Jhonn Montoya',
                'email' => 'montoya@gmail.com',
                'password' => bcrypt('password123')
            ],
            //nro 4
            [
                'name' => 'Carlinchi fjdsaklf',
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
    }
}
