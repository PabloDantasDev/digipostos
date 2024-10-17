<?php

namespace App\Console\Commands;

use App\Models\Combustivel;
use App\Models\Credito;
use Illuminate\Console\Command;

class UpdateCredito extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-credito';

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
        $creditos = Credito::get()
        ->map(function ($credito) {
            if($credito->fuel)
            {
                $combustivel = Combustivel::where('name', $credito->fuel)
                    ->first();

                $credito->combustivel_id = $combustivel->id;
                $credito->save();
            }
        });
    }
}
