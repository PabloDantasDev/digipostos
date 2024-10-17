<?php

namespace App\Http\Livewire\Cadastro\Veiculos;

use App\Models\Combustivel;
use App\Models\Prefeitura;
use App\Models\Secretaria;
use App\UseCases\Veiculo\CreateVeiculoUseCase;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $prefeituras;
    public $selectedPrefeitura = '';
    public $secretarias = [];
    public $combustiveis = [];
    public $selectedSecretaria = '';
    public $selectedCombustivel = '';

    public $veicName;
    public $veicPlate;
    public $veicModel;
    public $veicYear;
    public $veicProductor;
    public $veicColor;
    public $veicFuel;
    public $veicTank;
    public $veicInitialKM;
    public $veicFinalKM;
    
    public function mount()
    {
        $this->prefeituras = Prefeitura::all();
        $this->combustiveis = Combustivel::all();
    }
    
    public function render()
    {
        return view('livewire.cadastro.veiculos.create');
    }
    
    public function createVeiculo() : void
    {
        try {
            $useCase = new CreateVeiculoUseCase;

            $data = [
                'name' => $this->veicName,
                'license_plate' => $this->veicPlate,
                'model' => $this->veicModel,
                'year' => $this->veicYear,
                'productor' => $this->veicProductor,
                'color' => $this->veicColor,
                //'fuel' => $this->veicFuel,
                'tank_capacity' => $this->veicTank,
                'initial_km' => $this->veicInitialKM,
                'final_km' => $this->veicFinalKM,
                'prefeitura_id' => $this->selectedPrefeitura,
                'secretaria_id' => $this->selectedSecretaria,
                'combustivel_id' => $this->selectedCombustivel,
            ];

            $useCase->execute($data);

            $this->emitUp('veiculo created');
            $this->emitTo('flash-message', 'flashMessage', 'Veículo cadastrado com sucesso!');

            
            $this->veicName = '';
            $this->veicPlate = '';
            $this->veicModel = '';
            $this->veicYear = '';
            $this->veicProductor = '';
            $this->veicColor = '';
            $this->veicFuel = '';
            $this->veicTank = '';
            $this->veicInitialKM = '';
            $this->veicFinalKM = '';

            $this->selectedPrefeitura = '';
            $this->selectedSecretaria = '';
            $this->selectedCombustivel = '';

        } catch(Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }

    }

    public function refreshSecretarias() 
    {
        $this->secretarias = Secretaria::where('prefeitura_id', $this->selectedPrefeitura)->get();
    }

    public function refreshCombustiveis() 
    {
        $this->combustiveis = Combustivel::get();
    }
}
