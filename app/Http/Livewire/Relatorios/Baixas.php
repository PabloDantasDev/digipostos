<?php

namespace App\Http\Livewire\Relatorios;

use App\Models\Baixa;
use App\Models\Combustivel;
use App\Models\Secretaria;
use App\Models\Veiculo;
use App\UseCases\Baixa\CalcMediaBaixaUseCase;
use App\UseCases\Baixa\CalcMediaGeralBaixaUseCase;
use App\UseCases\Baixa\CalcTotalBaixaUseCase;
use App\UseCases\Baixa\CalcTotalGeralBaixaUseCase;
use App\UseCases\Baixa\NovosCalculosUseCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Baixas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $maxPages = 3;

    protected $listeners = [
        'calcMedia',
        'refresh',
        'chooseVeiculo',
    ];

    public $baixasData;
    public $veiculos;
    public $fuelType;

    public $initialDate;
    public $finalDate;
    public $searchVeiculo;
    public $secretarias;

    public $fuelAverage;
    public $average;
    public $fuelAveragePercent;
    public $averagePercent;
    public $totalGeralFuel;
    public $totalGeral;
    public $totalGasolina;
    public $totalDiesel;
    public $totalGNV;
    public $totalEtanol;

    public $lastDayAverage;
    public $fuelDayAveragePercent;
    public $fuelLastDayAverage;
    public $dayAveragePercent;
    public $fuelDayTotal;
    public $dayTotal;

    public $chosenSecretaria;

    public $chosenVeiculo;
    public $chosenPlate;
    public $veicFuelAverage;
    public $veicAverage;
    public $veicFuelAveragePercent;
    public $veicTotalFuel;
    public $veicTotal;

    public $combustiveis = [];
    public $general_consumption;
    public $today_consumption;
    public $average_daily_consumption;
    public $fuel_consumption;

    public $hasBaixas = false;
    
    public function mount() {
        $this->combustiveis = Combustivel::all();
        $hasBaixas = Baixa::orderBy('date')->where('id', '>', 0)->first();
        $this->secretarias = Secretaria::all();
        $this->veiculos = Veiculo::all();
        if ($hasBaixas) {
            $this->hasBaixas = true;
            $this->calcMedia();
            $this->emit('refreshChart');
            // $this->initialDate = Carbon::parse($hasBaixas->date);
            
            $geralUseCase = new CalcMediaGeralBaixaUseCase;
            $geralArray = $geralUseCase->execute();

            // Last Day Info
            $lastDay = Carbon::parse(date('Y-m-d'));
            $lastDayUseCase = new CalcMediaGeralBaixaUseCase;
            $lastDayTotalUseCase = new CalcTotalGeralBaixaUseCase;

            $dayArray = $lastDayUseCase->execute($lastDay);
            $totalDayArray = $lastDayTotalUseCase->execute($lastDay);

            if($dayArray != null) {
                
                $this->lastDayAverage = number_format($dayArray['value'], 2, ',', '');
                $this->fuelLastDayAverage = number_format($dayArray['liters'], 2, ',', '');
                $lastDayAverage = $dayArray['value'];
                $fuelLastDayAverage = $dayArray['liters'];
                
            
                if ($geralArray != null) {
                    $fuelDayAverage = $geralArray['liters'];
                    $dayAverage = $geralArray['value'];
                    if ($fuelDayAverage > 0) {
                        $this->fuelDayAveragePercent = number_format((($fuelLastDayAverage - $fuelDayAverage) / $fuelDayAverage) * 100, 2, ',', '');
                    }
                    if ($dayAverage > 0) {
                        $this->dayAveragePercent = number_format((($lastDayAverage - $dayAverage) / $dayAverage) * 100, 2, ',', '');
                    }
                }
            }
            if($totalDayArray != null) {
                $this->fuelDayTotal = $totalDayArray['liters'];
                $this->dayTotal = $totalDayArray['value'];
            }
        }

        $this->general_consumption = NovosCalculosUseCase::generalConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
        $this->today_consumption = NovosCalculosUseCase::todayConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
        $this->average_daily_consumption = NovosCalculosUseCase::averageDailyConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
    }
    
    public function render()
    {
        $query = Baixa::query();
        $query = $query->orderBy('date', 'desc')->orderBy('veiculo_id');
        // if ($this->searchVeiculo != null || $this->searchVeiculo != '') {
        //     $query = $query->whereExists(function ($subquery) {
        //         $subquery->select(DB::raw(1))
        //             ->from('veiculos')
        //             ->whereRaw('baixas.veiculo_id = veiculos.id')
        //             ->where('veiculos.license_plate', 'LIKE', '%' . $this->searchVeiculo . '%');
        //     });
        // }
        if($this->chosenVeiculo != null || $this->chosenVeiculo != ''){
            $query = $query->where('veiculo_id', $this->chosenVeiculo);
        }
        if (isset($this->initialDate) && $this->initialDate != '') {
            $initialDate = Carbon::parse($this->initialDate);
            $query = $query->where('date', '>=', $initialDate);
        }
        if (isset($this->finalDate) && $this->finalDate != '') {
            $finalDate = Carbon::parse($this->finalDate)->addDay();
            $query = $query->where('date', '<=', $finalDate);
        }
        if(isset($this->chosenSecretaria) && $this->chosenSecretaria != '') {
            $query = $query->whereHas('veiculo', function ($filtro) {
                $filtro->where('secretaria_id', $this->chosenSecretaria);
            });
        }
        if(isset($this->fuelType) && $this->fuelType != '') {
            $query = $query->whereHas('veiculo', function ($filtro) {
                $filtro->where('fuel', 'LIKE', $this->fuelType);
            });
        }
        $baixas = $query->paginate(15);
        $this->baixasData = NovosCalculosUseCase::litersByFuels($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType)->map(function($baixa) {
            return [
                'name' => $baixa->name,
                'liters' => $baixa->baixas[0]->liters
            ];
        });
        $this->fuel_consumption = $this->baixasData;
        $this->general_consumption = NovosCalculosUseCase::generalConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
        $this->today_consumption = NovosCalculosUseCase::todayConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
        $this->average_daily_consumption = NovosCalculosUseCase::averageDailyConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
        return view('livewire.relatorios.baixas', ['baixas' => $baixas]);
    }

    public function calcMedia($isVeic = null)
    {
        $useCase = new CalcMediaGeralBaixaUseCase;
        $totalGeralUseCase = new CalcTotalGeralBaixaUseCase;
        $everUseCase = new CalcMediaGeralBaixaUseCase;

        $firstDate = Carbon::parse($this->initialDate);
        $secondDate = Carbon::parse($this->finalDate)->endOfDay();
        if(!isset($this->initialDate) || $this->initialDate == '') {
            $firstDate = '';
        }
        $mediaGeral = $everUseCase->execute();
        $totalGeral = $totalGeralUseCase->execute($firstDate, $secondDate, $this->chosenSecretaria, $this->fuelType);
        $medias = $useCase->execute($firstDate, $secondDate, $this->chosenSecretaria, $this->fuelType);

        if ($totalGeral != null) {
            $this->totalGeralFuel = number_format($totalGeral['liters'], 2, ',', '');
            $this->totalGeral = number_format($totalGeral['value'], 2, ',', '');
            if(isset($totalGeral['pluck']['GASOLINA'])) {
                $this->totalGasolina = $totalGeral['pluck']['GASOLINA'];
            }
            if(isset($totalGeral['pluck']['DIESEL'])) {
                $this->totalDiesel = $totalGeral['pluck']['DIESEL'];
            }
            if(isset($totalGeral['pluck']['GNV'])) {
                $this->totalGNV = $totalGeral['pluck']['GNV'];
            }
            if(isset($totalGeral['pluck']['ETANOL'])) {
                $this->totalEtanol = $totalGeral['pluck']['ETANOL'];
            }
        }

        if ($medias != null && $mediaGeral != null) {

            $this->fuelAverage = number_format($medias['liters'], 2, ',', '');
            $this->average =  number_format($medias['value'], 2, ',', '');
            if($mediaGeral['liters'] > 0) {
                $this->fuelAveragePercent = number_format((($medias['liters'] - $mediaGeral['liters']) / $mediaGeral['liters']) * 100, 2, ',', '');
            }
            if($mediaGeral['value'] > 0) {
                $this->averagePercent = number_format((($medias['value'] - $mediaGeral['value']) / $mediaGeral['value']) * 100, 2, ',', '');
            }
            if(!isset($this->chosenVeiculo)) {
                $this->baixasData = $medias['pluck'];
            }

        }else {
            
            $this->fuelAverage = null;
            $this->average =  null;
            $this->totalGeralFuel = null;
            $this->totalGeral = null;
    
            $this->fuelAveragePercent = null;
            $this->averagePercent = null;
            $this->baixasData = ['TOTAL' => [date('d-m-Y'), 0]];

        }

        $this->emit('refreshChart');
        $this->emitSelf('refresh');
    }
    
    public function chooseVeiculo($veicId = null)
    {
        $isVeic = false;
        if ($veicId !== null) {
            if ($veicId > 0) {
                $this->chosenVeiculo = $veicId;
                $veiculo = Veiculo::find($veicId);
                $this->chosenPlate = $veiculo->license_plate;
                $this->fuelType = strtoupper($veiculo->fuel);
                $isVeic = true;
            } else {
                $this->chosenVeiculo = null;
                $this->chosenPlate = null;
                $this->fuelType = '';
            }
        }

        $this->emitSelf('calcMedia', $isVeic);

        if ($this->chosenVeiculo != null) {
            $useCase = new CalcMediaBaixaUseCase;
            $totalUseCase = new CalcTotalBaixaUseCase;
            $everUseCase = new CalcMediaBaixaUseCase;
            $everMedias = $everUseCase->execute($this->chosenVeiculo, null, null, $this->chosenSecretaria);
            
            $firstDate = Carbon::parse($this->initialDate);
            $secondDate = Carbon::parse($this->finalDate)->endOfDay();
            if(!isset($this->initialDate) || $this->initialDate == '') {
                $firstDate = '';
            }

            $medias = $useCase->execute($this->chosenVeiculo, $firstDate, $secondDate, $this->chosenSecretaria);
            $total = $totalUseCase->execute($this->chosenVeiculo, $firstDate, $secondDate, $this->chosenSecretaria);
    
            if($total != null) {
                $this->veicTotalFuel = number_format($total['liters'], 2, ',', '');
                $this->veicTotal = number_format($total['value'], 2, ',', '');
            }
            
            if (isset($medias['liters']) && $medias['liters'] > 0) {
                $this->veicFuelAveragePercent = number_format((($medias['liters'] - $everMedias['liters']) / $everMedias['liters']) * 100, 2, ',', '');
                
                $this->veicFuelAverage = number_format($medias['liters'], 2, ',', '');
                $this->veicAverage = number_format($medias['value'], 2, ',', '');
                $this->baixasData = $medias['pluck'];
                
            }else {
                
                $this->veicFuelAveragePercent = null;
                
                $this->veicFuelAverage = null;
                $this->veicAverage = null;

                $this->veicTotalFuel = null;
                $this->veicTotal = null;
                $this->baixasData = ['TOTAL' => [date('d-m-Y'), 0]];
            }
            $this->baixasData = NovosCalculosUseCase::litersByFuels($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType)->map(function($baixa) {
                return [
                    'name' => $baixa->name,
                    'liters' => $baixa->baixas[0]->liters
                ];
            });
            $this->general_consumption = NovosCalculosUseCase::generalConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
            $this->today_consumption = NovosCalculosUseCase::todayConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
            $this->average_daily_consumption = NovosCalculosUseCase::averageDailyConsumption($this->initialDate, $this->finalDate, $this->chosenSecretaria, $this->chosenVeiculo, $this->fuelType);
        } else {
            $this->veicFuelAveragePercent = null;
                
            $this->veicFuelAverage = null;
            $this->veicAverage = null;

            $this->veicTotalFuel = null;
            $this->veicTotal = null;
            
        }
    }
    
    public function refresh()
    {
        $this->resetPage();
    }

    public function refreshCombustiveis() 
    {
        $this->combustiveis = Combustivel::get();
    }
    
}
