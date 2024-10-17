<?php

namespace App\Http\Livewire\Cadastro\Servidores;

use App\Models\Secretaria;
use App\Models\Veiculo;
use App\UseCases\Servidor\CreateServidorUseCase;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $secretarias;
    public $selectedSecretaria = '';
    public $veiculos = [];
    public $selectedVeiculo = '';
    
    public $servName;
    public $servCPF;
    public $servRG;
    public $servSex;
    public $servPhone;
    public $servCellphone;
    public $servEmail;
    public $servPassword;
    public $servTerms;
    
    public function mount()
    {
        $this->secretarias = Secretaria::all();
    }
    
    public function render()
    {
        return view('livewire.cadastro.servidores.create');
    }
    
    public function createServidor() : void
    {
        try {
            $useCase = new CreateServidorUseCase;

            $data = [
               
                'name' => $this->servName,
                'cpf' => $this->servCPF,
                'rg' => $this->servRG,
                'sex' => $this->servSex,
                'secretaria_id' => $this->selectedSecretaria,
                'phone' => $this->servPhone,
                'cellphone' => $this->servCellphone,
                'email'=> $this->servEmail,
                'password' => $this->servPassword,
                'terms' => $this->servTerms,
                'veiculo_id' => $this->selectedVeiculo,

            ];

            $useCase->execute($data);

            $this->emitUp('servidor created');
            $this->emitTo('flash-message', 'flashMessage', 'Servidor cadastrado com sucesso!');

            
            $this->servName = '';
            $this->servCPF = '';
            $this->servRG = '';
            $this->servSex = '';
            $this->servPhone = '';
            $this->servCellphone = '';
            $this->servEmail = '';
            $this->servPassword = '';
            $this->servTerms = '';

            $this->selectedSecretaria = '';
            $this->selectedVeiculo = '';

        } catch(Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }

    }

    public function refreshVeiculos() 
    {
            $this->veiculos = Veiculo::where('secretaria_id', $this->selectedSecretaria)->get();
    }
}
