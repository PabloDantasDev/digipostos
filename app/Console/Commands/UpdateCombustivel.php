<?php

namespace App\Console\Commands;

use App\Models\Combustivel;
use App\Models\Veiculo;
use Illuminate\Console\Command;

class UpdateCombustivel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-combustivel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $veiculos = Veiculo::get()
            ->map(function ($veiculo) {
                if($veiculo->fuel)
                {
                    $combustivel = Combustivel::where('name', $veiculo->fuel)
                        ->first();

                    $veiculo->combustivel_id = $combustivel->id;
                    $veiculo->save();
                }
            });
    }
}
