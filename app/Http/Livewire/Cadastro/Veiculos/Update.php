<?php

namespace App\Http\Livewire\Cadastro\Veiculos;

use App\Models\Combustivel;
use App\Models\Secretaria;
use App\Models\Veiculo;
use App\UseCases\Qrcode\CreateQrcodeUseCase;
use App\UseCases\Veiculo\DeleteVeiculoUseCase;
use App\UseCases\Veiculo\UpdateVeiculoUseCase;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public $veiculo;
    public $secretarias = [];
    public $combustiveis= [];
    
    public $veicId;
    public $veicName;
    public $veicPlate;
    public $veicColor;
    public $veicFuel;
    public $veicTank;
    public $veicInitialKM;
    public $veicFinalKM;
    public $selectedSecretaria;
    public $selectedCombustivel;

    public $qrcode;
    public $credits;

    public function mount(Veiculo $veiculo)
    {
        $this->veiculo = $veiculo;
        $this->veicId = $veiculo->id;
        
        $this->veicName = $veiculo->name;
        $this->veicPlate = $veiculo->license_plate;
        $this->veicColor = $veiculo->color;
        $this->veicFuel = $veiculo->fuel;
        $this->veicTank = $veiculo->tank_capacity;
        $this->veicInitialKM = $veiculo->initial_km;
        $this->veicFinalKM = $veiculo->final_km;
        $this->selectedSecretaria = $veiculo->secretaria_id;
        $this->selectedCombustivel = $veiculo->combustivel_id ? $veiculo->combustivel_id : '';

        if(isset($veiculo->credito)){
            $this->credits = $veiculo->credito->value;
        }

        $this->combustiveis = Combustivel::get();
        $this->secretarias = Secretaria::where('prefeitura_id', $veiculo->prefeitura_id)->get();
    }
    
    public function render()
    {
        return view('livewire.cadastro.veiculos.update');
    }

    public function generateQR() 
    {
        $useCase = new CreateQrcodeUseCase;

        $this->qrcode = url($useCase->execute($this->veiculo->credito->id));
    }

    public function updateVeiculo() 
    {
        try {

            $useCase = new UpdateVeiculoUseCase;

            $data = [
                'name' => $this->veicName,
                'license_plate' => $this->veicPlate,
                'color' => $this->veicColor,
                //'fuel' => $this->veicFuel,
                'tank_capacity' => $this->veicTank,
                'initial_km' => $this->veicInitialKM,
                'final_km' => $this->veicFinalKM,
                'secretaria_id' => $this->selectedSecretaria,
                'combustivel_id' => $this->selectedCombustivel
            ];

            $useCase->execute($this->veicId, $data);

            $this->emitUp('veiculo updated');
            $this->emitTo('flash-message', 'flashMessage', 'Veículo atualizado com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function deleteVeiculo()
    {
        try {

            $useCase = new DeleteVeiculoUseCase;

            $useCase->execute($this->veicId);

            $this->emitUp('veiculo deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Veículo excluído com sucesso!');

        } catch (Exception $e) {
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
