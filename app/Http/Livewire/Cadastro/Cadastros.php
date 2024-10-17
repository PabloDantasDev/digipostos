<?php

namespace App\Http\Livewire\Cadastro;

use Livewire\Component;

class Cadastros extends Component
{
    public string $table = 'prefeituras';
    public ?int $prefeituraId = null;
    public ?int $secretariaId = null;

    protected $listeners = [
        'choose prefeitura' => 'chooseSecretarias',
        'choose secretaria' => 'chooseVeiculos',
    ];

    public function render()
    {
        return view('livewire.cadastro.cadastros');
    }

    public function choosePrefeituras() : void
    {
        $this->table = 'prefeituras';
    }

    public function chooseSecretarias( ?int $prefId = null ) : void
    {
        $this->prefeituraId = $prefId;
        $this->table = 'secretarias';
    }
    
    public function chooseVeiculos( ?int $secId = null ) : void
    {
        $this->secretariaId = $secId;
        $this->table = 'veiculos';
    }
    public function chooseServidores( ?int $secId = null ) : void
    {
        $this->secretariaId = $secId;
        $this->table = 'servidores';
    }

}
