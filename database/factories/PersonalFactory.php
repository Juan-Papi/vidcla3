<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
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
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'cargo' => $this->faker->jobTitle,
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'pais' => $this->faker->country,
            'ciudad' => $this->faker->city,
            'user_id' => User::factory(),
        ];
    }
}
