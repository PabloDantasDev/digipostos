<?php

namespace Database\Factories;

use App\Models\Prefeitura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prefeitura>
 */
class PrefeituraFactory extends Factory
{
    
    protected $model = Prefeitura::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'name' => fake()->realTextBetween(3, 50),
            'cnpj' => fake()->unique()->randomNumber(),
            'adress' => fake()->realTextBetween(5, 100),
            'city' => fake()->realTextBetween(3, 50),
            'uf' => fake()->realTextBetween(2, 10),
            'contact' => fake()->word(),
            'mayor' => fake()->realTextBetween(5, 30),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email()
            
        ];
    }
}
