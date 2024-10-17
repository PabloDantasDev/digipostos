<?php

namespace App\UseCases\Baixa;
use App\Models\Baixa;
use App\Models\Combustivel;
use Carbon\Carbon;

class NovosCalculosUseCase 
{
    public static function generalConsumption($initial_date = null, $final_date = null, $secretaria_id = null, $veiculo_id = null, $combustivel = null)
    {
        $sum_consumption = Baixa::selectRaw('sum(liters) as total_liters');

        if($initial_date)
        {
            $sum_consumption = $sum_consumption->where('date', '>=', $initial_date);
        }

        if($final_date)
        {
            $sum_consumption = $sum_consumption->where('date', '<=', $final_date);
        }

        if($secretaria_id)
        {
            $sum_consumption = $sum_consumption->whereHas('veiculo', fn ($filtro) => $filtro->where('secretaria_id', $secretaria_id));                
        }

        if($veiculo_id)
        {
            $sum_consumption = $sum_consumption->where('veiculo_id', $veiculo_id);
        }

        if($combustivel)
        {
            $sum_consumption = $sum_consumption->whereHas('veiculo', fn ($filtro) => $filtro->where('fuel', 'LIKE', $combustivel));
        }
            
        $sum_consumption = $sum_consumption->get()
            ->pluck('total_liters');

        return $sum_consumption[0];
    }

    public static function todayConsumption($initial_date = null, $final_date = null, $secretaria_id = null, $veiculo_id = null, $combustivel = null)
    {
        $sum_today_consumption = Baixa::selectRaw('sum(liters) as total_liters')
            ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]);
            
        if($initial_date)
        {
            $sum_today_consumption = $sum_today_consumption->where('date', '>=', $initial_date);
        }

        if($final_date)
        {
            $sum_today_consumption = $sum_today_consumption->where('date', '<=', $final_date);
        }

        if($secretaria_id)
        {
            $sum_today_consumption = $sum_today_consumption->whereHas('veiculo', fn ($filtro) => $filtro->where('secretaria_id', $secretaria_id));                
        }

        if($veiculo_id)
        {
            $sum_today_consumption = $sum_today_consumption->where('veiculo_id', $veiculo_id);
        }

        if($combustivel)
        {
            $sum_today_consumption = $sum_today_consumption->whereHas('veiculo', fn ($filtro) => $filtro->where('fuel', 'LIKE', $combustivel));
        }
            
        $sum_today_consumption = $sum_today_consumption->get()
            ->pluck('total_liters');

        return $sum_today_consumption[0];
    }

    public static function averageDailyConsumption($initial_date = null, $final_date = null, $secretaria_id = null, $veiculo_id = null, $combustivel = null)
    {
        $sum_total = NovosCalculosUseCase::generalConsumption($initial_date, $final_date, $secretaria_id, $veiculo_id, $combustivel);
        
        $days = Baixa::selectRaw('count(DISTINCT(date)) as count_days');

        if($initial_date)
        {
            $days = $days->where('date', '>=', $initial_date);
        }

        if($final_date)
        {
            $days = $days->where('date', '<=', $final_date);
        }

        if($secretaria_id)
        {
            $days = $days->whereHas('veiculo', fn ($filtro) => $filtro->where('secretaria_id', $secretaria_id));                
        }

        if($veiculo_id)
        {
            $days = $days->where('veiculo_id', $veiculo_id);
        }

        if($combustivel)
        {
            $days = $days->whereHas('veiculo', fn ($filtro) => $filtro->where('fuel', $combustivel));
        }
       
        
        $days = $days->get()        
            ->pluck('count_days');

        return $days[0] ? $sum_total / $days[0] : 0; 
    }

    public static function litersByFuels($initial_date = null, $final_date = null, $secretaria_id = null, $veiculo_id = null, $combustivel = null)
    {
        $fuels = Combustivel::with(['baixas' => function ($baixa) {
            $baixa->selectRaw('sum(liters) as liters');
            $baixa->groupBy('veiculos.combustivel_id');
        }])
            ->select('id', 'name')
            ->whereHas('baixas', function($baixa) use ($initial_date, $final_date, $secretaria_id, $veiculo_id, $combustivel){
                if($initial_date)
                {
                    $baixa = $baixa->where('date', '>=', $initial_date);
                }

                if($final_date)
                {
                    $baixa = $baixa->where('date', '<=', $final_date);
                }

                if($veiculo_id)
                {
                    $baixa = $baixa->where('veiculo_id', $veiculo_id);
                }
            });
        
        if($secretaria_id)
        {
            $fuels = $fuels->whereHas('veiculos', fn ($filtro) => $filtro->where('secretaria_id', $secretaria_id));                
        }

        if($combustivel)
        {
            $fuels = $fuels->where('name', $combustivel);
        }
    
        $fuels = $fuels->get();
        return $fuels;
    }
}