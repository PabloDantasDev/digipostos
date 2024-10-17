<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
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
            'phone' => fake()->phoneNumber(),
            'cellphone' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'password' => 'password',
            'terms' => fake()->sentence(),
            'posto_id' => 1,
            
        ];
    }
}
