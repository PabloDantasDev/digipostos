<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servidor>
 */
class ServidorFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'name' => fake()->word(),
            'cpf' => fake()->word(),
            'rg' => fake()->randomNumber(),
            'sex' => fake()->word(),
            'secretaria_id' => 1,
            'phone' => fake()->phoneNumber(),
            'cellphone' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'password' => 'password',
            'terms' => fake()->sentence(),
            'veiculo_id' => 1,
            
        ];
    }
}
