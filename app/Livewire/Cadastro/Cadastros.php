<?php

namespace App\Livewire\Cadastro;

use Livewire\Component;

class Cadastros extends Component
{
    public string $table = 'prefeituras';
    public ?int $prefeituraId = null;

    protected $listeners = [
        'choose prefeitura' => 'chooseSecretarias',
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
}
