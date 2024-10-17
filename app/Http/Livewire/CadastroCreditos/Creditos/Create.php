<?php

namespace App\Http\Livewire\CadastroCreditos\Creditos;

use App\Models\Combustivel;
use App\Models\Credito;
use App\Models\Posto;
use App\Models\Veiculo;
use App\UseCases\Credito\CreateCreditoUseCase;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $veiculos;
    public $selectedVeiculo = '';
    public $postos;
    public $selectedPosto = '';
    public $combustiveis = [];
    public $selectedCombustivel = '';
    
    public $fuelCredit;
    public $credFuel;
    public $credVpl;
    public $credValidity;
    
    public function mount($postos)
    {
        $this->combustiveis = Combustivel::all();
        $this->veiculos = Veiculo::all();
        $this->postos = $postos;
    }
    
    public function render()
    {
        return view('livewire.cadastro-creditos.creditos.create');
    }

    public function chooseVeiculo()
    {
        $veiculo = Veiculo::find($this->selectedVeiculo);

        $this->credFuel = strtoupper($veiculo->fuel);
    }
    
    public function createCredito() : void
    {
        try {
            $useCase = new CreateCreditoUseCase;

            $credValue = $this->fuelCredit * $this->credVpl;
            
            $data = [
                'value' => $credValue,
                //'fuel' => $this->credFuel,
                'value_per_liter' => $this->credVpl,
                'validity' => $this->credValidity,
                'veiculo_id' => $this->selectedVeiculo,
                'posto_id' => $this->selectedPosto,
                'fuel_credit' => $this->fuelCredit,
                'combustivel_id' => $this->selectedCombustivel,
            ];

            $alreadyExists = Credito::where('veiculo_id', $this->selectedVeiculo)->exists();
            
            if ($alreadyExists) {
                throw new Exception('Este veículo ja tem um crédito cadastrado!');
            }
            
            $useCase->execute($data);
            
            $this->emitUp('credito created');
            $this->emitTo('flash-message', 'flashMessage', 'Crédito cadastrado com sucesso!');

            
            $this->fuelCredit = '';
            $this->credFuel = '';
            $this->credVpl = '';
            $this->credValidity = '';
            $this->selectedVeiculo = '';
            $this->selectedPosto = '';
            $this->selectedCombustivel = '';

        } catch(Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }

    }

    public function refreshCombustiveis() 
    {
        $this->combustiveis = Combustivel::get();
    }
}
