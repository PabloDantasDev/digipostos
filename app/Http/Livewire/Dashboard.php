<?php

namespace App\Http\Livewire;

use App\Models\Secretaria;
use App\Models\Prefeitura;
use App\Models\Veiculo;
use App\Models\Servidor;
use App\UseCases\Baixa\CalcMediaGeralBaixaUseCase;
use App\UseCases\Baixa\NovosCalculosUseCase;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $lastWeekAverage;
    public $fuelLastWeekAverage;

    public $lastDayAverage;
    public $fuelLastDayAverage;
    
    public $fuelAveragePercent;
    public $averagePercent;
    public $fuelDayAveragePercent;
    public $dayAveragePercent;

    public $general_consumption;
    public $today_consumption;
    public $average_daily_consumption;

    public function mount()
    {
        // Contagem de secretarias
        $this->secretariaCount = Secretaria::count();
        $this->countPrefeitura = Prefeitura::count();
        $this->countVeiculos = Veiculo::count();
        $this->countServidores = Servidor::count();

        // Calcular médias e consumos
        $this->calculateConsumptions();
    }

    private function calculateConsumptions($initialDate = null, $finalDate = null, $chosenSecretaria = null, $chosenVeiculo = null, $fuelType = null)
    {
        // Calcular consumo geral e diário
        $this->general_consumption = NovosCalculosUseCase::generalConsumption($initialDate, $finalDate, $chosenSecretaria, $chosenVeiculo, $fuelType);
        $this->today_consumption = NovosCalculosUseCase::todayConsumption($initialDate, $finalDate, $chosenSecretaria, $chosenVeiculo, $fuelType);
        $this->average_daily_consumption = NovosCalculosUseCase::averageDailyConsumption($initialDate, $finalDate, $chosenSecretaria, $chosenVeiculo, $fuelType);

        // Calcular médias semanais e diárias
        $geralUseCase = new CalcMediaGeralBaixaUseCase;
        $geralArray = $geralUseCase->execute();

        $lastWeekSunday = Carbon::now()->startOfWeek()->subWeek();
        $lastWeekSaturday = Carbon::now()->endOfWeek()->subWeek();

        $array = $geralUseCase->execute($lastWeekSunday, $lastWeekSaturday);
        if ($array != null) {
            $this->lastWeekAverage = number_format($array['value'], 2, ',', '');
            $this->fuelLastWeekAverage = number_format($array['liters'], 1, ',', '');
            
            if ($geralArray != null) {
                $fuelAverage = $geralArray['liters'];
                $average = $geralArray['value'];
                if ($fuelAverage > 0) {
                    $this->fuelAveragePercent = number_format((($array['liters'] - $fuelAverage) / $fuelAverage) * 100, 2, ',', '');
                }
                if ($average > 0) {
                    $this->averagePercent = number_format((($array['value'] - $average) / $average) * 100, 2, ',', '');
                }
            }
        }

        // Cálculo para o último dia
        $lastDay = Carbon::parse(date('Y-m-d'));
        $dayArray = $geralUseCase->execute($lastDay);

        if ($dayArray != null) {
            $this->lastDayAverage = number_format($dayArray['value'], 2, ',', '');
            $this->fuelLastDayAverage = number_format($dayArray['liters'], 1, ',', '');

            if ($geralArray != null) {
                $fuelDayAverage = $geralArray['liters'];
                $dayAverage = $geralArray['value'];
                if ($fuelDayAverage > 0) {
                    $this->fuelDayAveragePercent = number_format((($dayArray['liters'] - $fuelDayAverage) / $fuelDayAverage) * 100, 2, ',', '');
                }
                if ($dayAverage > 0) {
                    $this->dayAveragePercent = number_format((($dayArray['value'] - $dayAverage) / $dayAverage) * 100, 2, ',', '');
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
