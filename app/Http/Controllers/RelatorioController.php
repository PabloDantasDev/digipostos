<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Baixa;
use App\UseCases\Baixa\CalcMediaBaixaUseCase;
use App\UseCases\Baixa\CalcMediaGeralBaixaUseCase;
use App\UseCases\Baixa\CalcTotalBaixaUseCase;
use App\UseCases\Baixa\CalcTotalGeralBaixaUseCase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function baixas(Request $request)
    {
        return view('content.components.relatorios.baixas');
    }

    public function print(Request $request)
    {
        $veicId = $request->veicId;
        $secId = $request->secId;
        $initialDate = $request->initialDate;
        $finalDate = $request->finalDate;
        $fuelType = $request->fuelType;

        $fuelAverage = null;
        $fuelAveragePercent = null;
        $totalGeralFuel = null;
        $veicFuelAverage = null;
        $veicFuelAveragePercent= null;
        $veicTotalFuel = null;
        $totalGasolina = null;
        $totalDiesel = null;
        $totalGNV = null;
        $totalEtanol = null;

        // QUERY
        $query = Baixa::query();
        $query = $query->orderBy('date', 'desc')->orderBy('veiculo_id');
        if($veicId != null || $veicId != ''){
            $query = $query->where('veiculo_id', $veicId);
        }
        if (isset($initialDate) && $initialDate != '') {
            $initialDate = Carbon::parse($initialDate);
            $query = $query->where('date', '>=', $initialDate);
        }
        if (isset($finalDate) && $finalDate != '') {
            $finalDate = Carbon::parse($finalDate)->addDay();
            $query = $query->where('date', '<=', $finalDate);
        }
        if(isset($secId) && $secId != '') {
            $query = $query->whereHas('veiculo', function ($filtro) use ($secId) {
                $filtro->where('secretaria_id', $secId);
            });
        }
        if(isset($fuelType) && $fuelType != '') {
            $query = $query->whereHas('veiculo', function ($filtro) use($fuelType) {
                $filtro->where('fuel', 'LIKE', $fuelType);
            });
        }
        $baixas = $query->get();
        // END QUERY


        
        // LAST DAY INFO
        $geralUseCase = new CalcMediaGeralBaixaUseCase;
        $geralArray = $geralUseCase->execute();

        $lastDay = Carbon::parse(date('Y-m-d'));
        $lastDayUseCase = new CalcMediaGeralBaixaUseCase;

        $dayArray = $lastDayUseCase->execute($lastDay);

        if($dayArray != null) {
            $lastDayAverage = number_format($dayArray['value'], 2, ',', '');
            // Fuel Last Day Average (consumo médio de hoje)
            $fuelLastDayAverage = number_format($dayArray['liters'], 2, ',', '');
            $lastDayAverage = $dayArray['value'];
            $fuelLastDayAverage = $dayArray['liters'];
            
        
            if ($geralArray != null) {
                $fuelDayAverage = $geralArray['liters'];
                $dayAverage = $geralArray['value'];
                if ($fuelDayAverage > 0) {
                    $fuelDayAveragePercent = number_format((($fuelLastDayAverage - $fuelDayAverage) / $fuelDayAverage) * 100, 2, ',', '');
                }
                if ($dayAverage > 0) {
                    $dayAveragePercent = number_format((($lastDayAverage - $dayAverage) / $dayAverage) * 100, 2, ',', '');
                }
            }
        }
        // END LAST DAY INFO


        // GERAL
        $useCase = new CalcMediaGeralBaixaUseCase;
        $totalGeralUseCase = new CalcTotalGeralBaixaUseCase;
        $everUseCase = new CalcMediaGeralBaixaUseCase;

        $firstDate = Carbon::parse($initialDate);
        $secondDate = Carbon::parse($finalDate)->endOfDay();
        if(!isset($initialDate) || $initialDate == '') {
            $firstDate = '';
        }
        $mediaGeral = $everUseCase->execute();
        $totalGeral = $totalGeralUseCase->execute($firstDate, $secondDate, $secId, $fuelType);
        $medias = $useCase->execute($firstDate, $secondDate, $secId, $fuelType);

        if ($totalGeral != null) {
            // Total Geral Fuel (Consumo total)
            $totalGeralFuel = number_format($totalGeral['liters'], 2, ',', '');
            $totalGeralValue = number_format($totalGeral['value'], 2, ',', '');
            // Total por combustível
            if(isset($totalGeral['pluck']['GASOLINA'])) {
                $totalGasolina = $totalGeral['pluck']['GASOLINA'];
            }
            if(isset($totalGeral['pluck']['DIESEL'])) {
                $totalDiesel = $totalGeral['pluck']['DIESEL'];
            }
            if(isset($totalGeral['pluck']['GNV'])) {
                $totalGNV = $totalGeral['pluck']['GNV'];
            }
            if(isset($totalGeral['pluck']['ETANOL'])) {
                $totalEtanol = $totalGeral['pluck']['ETANOL'];
            }
        }

        if ($medias != null && $mediaGeral != null) {
            // Fuel Average (consumo médio)
            $fuelAverage = number_format($medias['liters'], 2, ',', '');
            $average =  number_format($medias['value'], 2, ',', '');
            if($mediaGeral['liters'] > 0) {
                // Fuel Average Percent (porcentagem do consumo médio)
                $fuelAveragePercent = number_format((($medias['liters'] - $mediaGeral['liters']) / $mediaGeral['liters']) * 100, 2, ',', '');
            }
            if($mediaGeral['value'] > 0) {
                $averagePercent = number_format((($medias['value'] - $mediaGeral['value']) / $mediaGeral['value']) * 100, 2, ',', '');
            }
            $baixasData = $medias['pluck'];
        }else {
            $baixasData = ['TOTAL' => [date('d-m-Y'), 0]];
        }
        // END GERAL


        // VEICULO 

        if ($veicId != null && $veicId != '') {
            $useCase = new CalcMediaBaixaUseCase;
            $totalUseCase = new CalcTotalBaixaUseCase;
            $everUseCase = new CalcMediaBaixaUseCase;
            $everMedias = $everUseCase->execute($veicId, null, null, $secId);
            
            $firstDate = Carbon::parse($initialDate);
            $secondDate = Carbon::parse($finalDate)->endOfDay();
            if(!isset($initialDate) || $initialDate == '') {
                $firstDate = '';
            }

            $medias = $useCase->execute($veicId, $firstDate, $secondDate, $secId);
            $total = $totalUseCase->execute($veicId, $firstDate, $secondDate, $secId);
    
            if($total != null) {
                // Veic Total Fuel (consumo total do veiculo)
                $veicTotalFuel = number_format($total['liters'], 2, ',', '');
                $veicTotal = number_format($total['value'], 2, ',', '');
            }
            
            if (isset($medias['liters']) && $medias['liters'] > 0) {
                // Veic Fuel Average Percent (porcentagem do consumo médio do veiculo)
                $veicFuelAveragePercent = number_format((($medias['liters'] - $everMedias['liters']) / $everMedias['liters']) * 100, 2, ',', '');
                // Veic Fuel Average (consumo médio do veiculo)
                $veicFuelAverage = number_format($medias['liters'], 2, ',', '');
                $veicAverage = number_format($medias['value'], 2, ',', '');
                $baixasData = $medias['pluck'];
                
            }else {
                $baixasData = ['TOTAL' => [date('d-m-Y'), 0]];
            }
        }
        // END VEICULO


        // GET DATES
        if ($initialDate == null) {

        }
        return view('content.components.relatorios.print')->with(compact(
            'initialDate', 'finalDate',
            'veicId', 'secId', 'fuelType',
            'baixasData', 'baixas',
            'veicFuelAverage', 'veicFuelAveragePercent', 'veicTotalFuel',
            'fuelAverage', 'fuelAveragePercent', 'totalGeralFuel',
            'totalGasolina', 'totalDiesel', 'totalGNV', 'totalEtanol',
        ));
    }
}
