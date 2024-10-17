<?php

namespace App\Http\Livewire\Pages\Servidor;

use App\UseCases\Qrcode\CreateQrcodeUseCase;
use Livewire\Component;

class Home extends Component
{
    public $name;
    public $cpf;
    public $prefeitura;
    public $logo;
    public $secretaria;
    public $veiculoName;
    public $license_plate;
    public $tank_capacity;
    public $credits;
    public $posto;

    public $credId;
    public $qrcode;

    public function mount($user)
    {
        $this->name = $user->department->name;
        $this->cpf = $user->department->cpf;
        $this->prefeitura = $user->department->secretaria->prefeitura->name;
        $this->logo = $user->department->secretaria->prefeitura->logo;
        $this->secretaria = $user->department->secretaria->name;
        $this->veiculoName = $user->department->veiculo->name;
        $this->license_plate = $user->department->veiculo->license_plate;
        $this->tank_capacity = $user->department->veiculo->tank_capacity;
        if (isset($user->department->veiculo->credito)) {
            $this->credId = $user->department->veiculo->credito->id;
            $this->credits = $user->department->veiculo->credito->fuel_credit;
            $this->posto = $user->department->veiculo->credito->posto->name;
        }
    }
    
    public function render()
    {
        return view('livewire.pages.servidor.home');
    }

    public function generate()
    {
        $useCase = new CreateQrcodeUseCase;

        $this->qrcode = $useCase->execute($this->credId);
    }
}
