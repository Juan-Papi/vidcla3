<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'carnet' => $this->faker->unique()->randomNumber,
            'nombre' => $this->faker->name,
            'materno' => $this->faker->lastName,
            'paterno' => $this->faker->lastName,
            'ciudad' => $this->faker->city,
            'sexo' => $this->faker->randomElement(['masculino', 'femenino']),
        ];
    }
}
