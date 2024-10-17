<?php 

namespace App\UseCases\Baixa;

use App\Models\Baixa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;

class CalcMediaBaixaUseCase
{
    public function execute(int $veicId, $firstDate = null, $secondDate = null, $secretaria = null): ?array
    {
        $dataLimit = false;
        $baixas = Baixa::query()->orderBy('date');
        $baixas = $baixas->where('veiculo_id', $veicId);
        if (isset($firstDate) && $firstDate != '') {
            $baixas = $baixas->where('date', '>=', $firstDate);
        } else {
            $dataLimit = true;
            $firstBaixa = Baixa::orderBy('date')->where('veiculo_id', $veicId)->first();
            if (isset($secretaria) && $secretaria != '') {
                $firstBaixa = Baixa::orderBy('date')->whereHas('veiculo', function ($filtro) use ($secretaria) {
                    $filtro->where('secretaria_id', $secretaria);
                })->first();
            }
            if($firstBaixa) {
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
        $data = $dataLimit ? $baixas->where('date', '>=', Carbon::now()->subDays(30)) : $baixas;

        $baixas = $baixas->get();
        $data = $data->get();

        $group = $data->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });

        $pluck = [];

        foreach ($group as $date => $items) {
            $totalLiters = $items->sum('liters');
            $pluck['TOTAL'][Carbon::parse($date)->format('d-m-Y')] = $totalLiters;
        }
        
        $medias = ['liters' => 0, 'value' => 0, 'pluck' => $pluck];

        if($baixas->count() < 1) {
            return null;    
        }
        
        foreach($baixas as $baixa) {
            $medias['liters'] += $baixa->liters;
            $medias['value'] += $baixa->value;
        }
        if (!isset($firstDate) || $firstDate == '') {
            
        }
        $firstDate = Carbon::parse($firstDate);
        $secondDate = Carbon::parse($secondDate);
        $days = $firstDate->diffInDays($secondDate) + 1;

        $medias['liters'] = $medias['liters'] / $days;
        $medias['value'] = $medias['value'] / $days;
        
        return $medias;
    }
    

}