<?php

namespace App\Http\Livewire\Cadastro\Prefeituras;


use App\UseCases\Prefeitura\CreatePrefeituraUseCase;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    
    public string $prefName = '';
    public string $prefCNPJ = '';
    public string $prefAdress = '';
    public string $prefCity = '';
    public string $prefUF = '';
    public string $prefContact = '';
    public string $prefMayor = '';
    public string $prefPhone = '';
    public string $prefEmail = '';
    public string $prefPassword = '';
    public $imageFile;

    public function render()
    {
        return view('livewire.cadastro.prefeituras.create');
    }

    public function createPrefeitura() : void
    {
        try {
            $useCase = new CreatePrefeituraUseCase;

            $data = [
                'name' => $this->prefName,
                'cnpj' => $this->prefCNPJ,
                'adress' => $this->prefAdress,
                'city' => $this->prefCity,
                'uf' => $this->prefUF,
                'contact' => $this->prefContact,
                'mayor' => $this->prefMayor,
                'phone' => $this->prefPhone,
                'email' => $this->prefEmail,
                'logo' => $this->imageFile,
                'password' => $this->prefPassword
            ];

            $useCase->execute($data);

            $this->emitUp('prefeitura created');
            $this->emitTo('flash-message', 'flashMessage', 'Prefeitura cadastrada com sucesso!');

            
            $this->prefName = '';
            $this->prefCNPJ = '';
            $this->prefAdress = '';
            $this->prefCity = '';
            $this->prefUF = '';
            $this->prefContact = '';
            $this->prefMayor = '';
            $this->prefPhone = '';
            $this->prefEmail = '';
            $this->prefPassword = '';
            $this->imageFile = null;

        } catch(Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }

    }
}
