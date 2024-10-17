<?php

namespace App\Http\Livewire\Pages\Funcionario;

use App\Models\Credito;
use App\Models\Servidor;
use App\UseCases\Baixa\CreateBaixaUseCase;
use App\UseCases\Credito\SubtractCreditoUseCase;
use Exception;
use Livewire\Component;

class Home extends Component
{
    public $user;
    public $notQR;
    public $creditos;
    public $chosenCred;
    
    public $veiculoId;
    public $funcionarioId;
    public $creditoId;
    
    public $prefeitura;
    public $logo;
    public $secretaria;
    public $license_plate;
    public $tank_capacity;
    public $credits;
    public $posto;
    public $frentista;

    public $liters;
    public $vpl;

    protected $listeners = [
        'select2Updated' => 'chooseCred',
    ];

    public function mount($user, $credId)
    {
        $this->user = $user;
        if ($credId) {
            $credito = Credito::find($credId);
            if($credito) {
                $this->prefeitura = $credito->veiculo->secretaria->prefeitura->name;
                $this->logo = $credito->veiculo->secretaria->prefeitura->logo;
                $this->secretaria = $credito->veiculo->secretaria->name;
                $this->license_plate = $credito->veiculo->license_plate;
                $this->tank_capacity = $credito->veiculo->tank_capacity;
                $this->credits = $credito->fuel_credit;
                $this->posto = $credito->posto->name;
                $this->vpl = $credito->value_per_liter;
                $this->creditoId = $credito->id;
                $this->veiculoId = $credito->veiculo->id;
            }
        } else {
            $this->notQR = true;
            
            $this->creditos = Credito::all();
        }
        $this->funcionarioId = $user->department->id;
    }
    

    public function render()
    {
        return view('livewire.pages.funcionario.home');
    }

    public function chooseCred($chosenCred)
    {
        $this->chosenCred = $chosenCred;
        $credito = Credito::find($chosenCred);
        if($credito) {
            $this->prefeitura = $credito->veiculo->secretaria->prefeitura->name;
            $this->logo = $credito->veiculo->secretaria->prefeitura->logo;
            $this->secretaria = $credito->veiculo->secretaria->name;
            $this->license_plate = $credito->veiculo->license_plate;
            $this->tank_capacity = $credito->veiculo->tank_capacity;
            $this->credits = $credito->fuel_credit;
            $this->posto = $credito->posto->name;
            $this->vpl = $credito->value_per_liter;
            $this->creditoId = $credito->id;
            $this->veiculoId = $credito->veiculo->id;
        }
    }

    public function discount() 
    {
        try {
            $credValue = $this->liters * $this->vpl;
            
            if ($this->liters > $this->credits) {
                throw new Exception('Erro! Débito inválido, verifique os valores e tente novamente!');
            }
            $subtractUseCase = new SubtractCreditoUseCase;
            $subtractData = [
                'value' => $credValue,
                'fuel_credit' => $this->liters,
            ];
            $baixaUseCase = new CreateBaixaUseCase;
            $baixaData = [
                'value' => $credValue,
                'liters' => $this->liters,
                'date' => now(),
                'veiculo_id' => $this->veiculoId,
                'funcionario_id' => $this->funcionarioId,
            ];

            $subtractUseCase->execute($this->creditoId, $subtractData);
            $baixaUseCase->execute($baixaData);

            redirect()->route('confirm-debit');
            
        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
