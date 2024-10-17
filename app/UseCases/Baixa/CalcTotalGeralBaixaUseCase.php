<?php 

namespace App\UseCases\Baixa;

use App\Models\Baixa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;

class CalcTotalGeralBaixaUseCase
{
    public function execute($firstDate = null, $secondDate = null, $secretaria = null, $fuelType = null): ?array
    {
        $baixas = Baixa::query();
        if (isset($firstDate) && $firstDate != '') {
            $baixas = $baixas->where('date', '>=', $firstDate);
        }else {
            $firstBaixa = Baixa::orderBy('date')->first();
            if (isset($secretaria) && $secretaria != '') {
                $firstBaixa = Baixa::orderBy('date')->whereHas('veiculo', function ($filtro) use ($secretaria) {
                    $filtro->where('secretaria_id', $secretaria);
                })->first();
            }if($firstBaixa) {
                $firstDate = $firstBaixa->date;
                $baixas = $baixas->where('date', '>=', $firstDate);
            }
        }
        if (isset($secondDate) && $secondDate != '') {
            $baixas = $baixas->where('date', '<=', $secondDate);
        }
        if (isset($secretaria) && $secretaria != '') {
            $baixas = $baixas->whereHas('veiculo', function ($filtro) use ($secretaria) {
                $filtro->where('secretaria_id', $secretaria);
            });
        }
        if (isset($fuelType) && $fuelType != '') {
            $baixas = $baixas->whereHas('veiculo', function ($filtro) use ($fuelType) {
                $filtro->where('fuel', 'LIKE', $fuelType);
            });
        }
        
        $baixas = $baixas->get();
        
        
        $group = $baixas->groupBy(function($item) {
            return $item->created_at->format('d-m-y');
        });
        $dates = $group->keys(); // Obter todas as datas existentes nos registros de baixa

        $grupo = $baixas->groupBy(function($item) {
            return strtoupper($item->veiculo->fuel);
        })->map(function($group) {
            return $group->groupBy(function($item) {
                return $item->created_at->format('d-m-y');
            });
        });

        $groupArray = [];
        foreach ($group as $date => $items) {
            $totalLiters = $items->sum('liters');
            $groupArray[Carbon::parse($date)->format('d-m-Y')] = $totalLiters;
        }
        
        $array = ['TOTAL' => $groupArray];

        foreach ($grupo as $fuelType => $data) {
            // Inicializar um array para armazenar os dados de litros para este tipo de combustível
            $litersData = [];
        
            // Iterar sobre todas as datas
            foreach ($dates as $date) {
                // Verificar se há litros para a data atual
                if ($data->has($date)) {
                    // Se houver litros para a data atual, armazenar os litros
                    $litersData[$date] = $data[$date]->sum('liters');
                } else {
                    // Se não houver litros para a data atual, definir o valor como 0
                    $litersData[$date] = 0;
                }
            }
        
            // Adicionar os dados de litros para este tipo de combustível ao array principal
            $array[$fuelType] = $litersData;
        }
        // Array para armazenar as somas de cada item
        $somas = [];

        // Iterar sobre o array principal
        foreach ($array as $item => $subArray) {
            // Calcular a soma dos valores do subarray
            $soma = collect($subArray)->sum();
            // Armazenar a soma no array de somas
            $somas[$item] = $soma;
        }
        $medias = ['liters' => 0, 'value' => 0, 'pluck' => $somas];

        if($baixas->count() < 1) {
            return null;
        }
        
        foreach($baixas as $baixa) {
            $medias['liters'] += $baixa->liters;
            $medias['value'] += $baixa->value;
        }

        $count = $baixas->filter(function ($baixa) {
            return $baixa->veiculo !== null; // Verifica se há um veículo relacionado
        })->unique('veiculo_id')->count();

        if($count <= 0) {
            return $medias;
        }

        return $medias;
    }
    

}