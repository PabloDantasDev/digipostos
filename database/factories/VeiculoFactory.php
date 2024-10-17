<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veiculo>
 */
class VeiculoFactory extends Factory
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
            'license_plate' => fake()->word(),
            'model' => fake()->word(),
            'year' => fake()->randomNumber(4),
            'productor' => fake()->word(),
            'color' => fake()->word(),
            'fuel' => fake()->word(),
            'tank_capacity' => fake()->numberBetween(20, 45),
            'initial_km' => fake()->randomNumber(),
            'final_km' => fake()->randomNumber(),

            'prefeitura_id' => 1,
            'secretaria_id' => 1,
            
        ];
    }
}
