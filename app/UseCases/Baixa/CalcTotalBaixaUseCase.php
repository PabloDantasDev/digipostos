<?php 

namespace App\UseCases\Baixa;

use App\Models\Baixa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;

class CalcTotalBaixaUseCase
{
    public function execute(int $veicId, $firstDate = null, $secondDate = null, $secretaria = null): ?array
    {
        $baixas = Baixa::query();
        $baixas = $baixas->where('veiculo_id', $veicId);
        if (isset($firstDate) && $firstDate != '') {
            $baixas = $baixas->where('date', '>=', $firstDate);
        } else {
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
        $baixas = $baixas->get();
        $medias = ['liters' => 0, 'value' => 0];

        if($baixas->count() < 1) {
            return null;    
        }
        
        foreach($baixas as $baixa) {
            $medias['liters'] += $baixa->liters;
            $medias['value'] += $baixa->value;
        }
        
        return $medias;
    }
    

}