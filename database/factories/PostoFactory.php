<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posto>
 */
class PostoFactory extends Factory
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
        'adress' => fake()->sentence(),
        'cnpj' => fake()->unique()->randomNumber(),
        'inscription' => fake()->randomNumber(),
        'city' => fake()->word(),
        'uf' => fake()->realTextBetween(2, 10),
        'phone' => fake()->phoneNumber(),
        'email' => fake()->unique()->email(),

        ];
    }
}
