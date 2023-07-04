<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;//importante para el uso de str


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'año' => $this->faker->year,
            'descripcion' => Str::limit($this->faker->paragraph, 150),
           // 'marca_id' => Marca::factory(),// también estamos creando una Marca
           'marca_id' => Marca::all()->random()->id,// asignar a cada Vehiculo una Marca existente aleatoriamente, 

        ];
    }
}
