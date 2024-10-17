<?php

namespace App\Http\Livewire;

use App\UseCases\Baixa\CalcMediaGeralBaixaUseCase;
use App\UseCases\Baixa\NovosCalculosUseCase;
use Carbon\Carbon;
use DateInterval;
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

    public function mount()
    {
        $geralUseCase = new CalcMediaGeralBaixaUseCase;
        $geralArray = $geralUseCase->execute();

        $lastWeekSunday = Carbon::now()->startOfWeek()->subWeek();
        $lastWeekSaturday = Carbon::now()->endOfWeek()->subWeek();
        $lastWeekUseCase = new CalcMediaGeralBaixaUseCase;

        $array = $lastWeekUseCase->execute($lastWeekSunday, $lastWeekSaturday);
        if($array != null) {
            
            $this->lastWeekAverage = number_format($array['value'], 2, ',', '');
            $this->fuelLastWeekAverage = number_format($array['liters'], 1, ',', '');
            $lastWeekAverage = $array['value'];
            $fuelLastWeekAverage = $array['liters'];
            
            if ($geralArray != null) {
                $fuelAverage = $geralArray['liters'];
                $average = $geralArray['value'];
                if ($fuelAverage > 0){
                    $this->fuelAveragePercent = number_format((($fuelLastWeekAverage - $fuelAverage) / $fuelAverage) * 100, 2, ',', '');
                }
                if ($average > 0) {
                    $this->averagePercent = number_format((($lastWeekAverage - $average) / $average) * 100, 2, ',', '');
                }
            }
        }


        // Last Day Info
        $lastDay = Carbon::parse(date('Y-m-d'));
        $lastDayUseCase = new CalcMediaGeralBaixaUseCase;

        $dayArray = $lastDayUseCase->execute($lastDay);

        if($dayArray != null) {
            
            $this->lastDayAverage = number_format($dayArray['value'], 2, ',', '');
            $this->fuelLastDayAverage = number_format($dayArray['liters'], 1, ',', '');
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

        $this->general_consumption = NovosCalculosUseCase::generalConsumption();
        $this->today_consumption = NovosCalculosUseCase::todayConsumption();
    }
    
    public function render()
    {
        return view('livewire.dashboard');
    }
}
