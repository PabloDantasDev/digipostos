<?php

namespace Database\Seeders;

use App\Models\Combustivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CombustivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Combustivel::create([
            'name' => 'GASOLINA'
        ]);
        Combustivel::create([
            'name' => 'ETANOL'
        ]);
        Combustivel::create([
            'name' => 'DIESEL'
        ]);
        Combustivel::create([
            'name' => 'GNV'
        ]);
    }
}
