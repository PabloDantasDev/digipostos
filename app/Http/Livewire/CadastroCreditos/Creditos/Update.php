<?php

namespace App\Http\Livewire\CadastroCreditos\Creditos;

use App\Models\Combustivel;
use App\Models\Credito;
use App\Models\Posto;
use App\UseCases\Credito\AddCreditoUseCase;
use App\UseCases\Credito\DeleteCreditoUseCase;
use App\UseCases\Credito\UpdateCreditoUseCase;
use App\UseCases\Qrcode\CreateQrcodeUseCase;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public $postos;
    public $selectedPosto = '';
    public $combustiveis= [];
    public $selectedCombustivel;

    public $credito;
    
    public $credId;
    public $fuelCredit;
    public $credFuel;
    public $credVpl;
    public $credValidity;

    public $credAdd;
    public $credAddValidity;

    public $creditoAtual;
    public $vplAtual;

    public $qrcode;
    
    public function mount(Credito $credito, $postos)
    {
        $this->combustiveis = Combustivel::get();
        $this->credito = $credito;
        
        $this->credId = $credito->id;
        $this->fuelCredit = $credito->fuel_credit;
        $this->credFuel = $credito->fuel;
        $this->credVpl = $credito->value_per_liter;
        $this->credValidity = $credito->validity;
        $this->selectedCombustivel = $credito->combustivel_id ? $credito->combustivel_id : '';

        $this->postos = $postos;
        $this->selectedPosto = $credito->posto->id;

        $this->creditoAtual = $credito->fuel_credit;
        $this->vplAtual = $credito->value_per_liter;
        
    }
    
    public function render()
    {
        return view('livewire.cadastro-creditos.creditos.update');
    }
    
    public function generateQR() 
    {
        $useCase = new CreateQrcodeUseCase;

        $this->qrcode = url($useCase->execute($this->credito->id));
    }

    public function updateCredito() 
    {
        try {
            $credValue = $this->fuelCredit * $this->credVpl;
            
            $useCase = new UpdateCreditoUseCase;

            $data = [
                'value' => $credValue,
                //'fuel' => $this->credFuel,
                'value_per_liter' => $this->credVpl,
                'validity' => $this->credValidity,
                'posto_id' => $this->selectedPosto,
                'fuel_credit' => $this->fuelCredit,
                'combustivel_id' => $this->selectedCombustivel
            ];

            $useCase->execute($this->credId, $data);

            $this->emitUp('credito updated');
            $this->emitTo('flash-message', 'flashMessage', 'Crédito atualizado com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function deleteCredito()
    {
        try {

            $useCase = new DeleteCreditoUseCase;

            $useCase->execute($this->credId);

            $this->emitUp('credito deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Crédito excluído com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function addCredito()
    {
        try {

            $credValue = $this->creditoAtual * $this->vplAtual;
            
            $useCase = new AddCreditoUseCase;
            
            $data = [
                'value' => $credValue,
                'fuel_credit' => $this->credAdd,
                'validity' => $this->credAddValidity,
            ];

            $useCase->execute($this->credId, $data);

            $this->emitUp('credito updated');
            $this->emitTo('flash-message', 'flashMessage', 'Crédito adicionado com sucesso!');

            $this->credAdd = '';

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function refreshCombustiveis() 
    {
        $this->combustiveis = Combustivel::get();
    }
}
