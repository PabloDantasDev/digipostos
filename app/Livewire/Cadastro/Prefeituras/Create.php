<?php

namespace App\Livewire\Cadastro\Prefeituras;

use App\UseCases\Prefeitura\CreatePrefeituraUseCase;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public string $prefName;
    public string $prefCNPJ;
    public string $prefAdress;
    public string $prefCity;
    public string $prefUF;
    public string $prefContact;
    public string $prefMayor;
    public string $prefPhone;
    public string $prefEmail;

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
            ];

            $useCase->execute($data);

            $this->emitUp('prefeitura created');

            
            $this->prefName = '';
            $this->prefCNPJ = '';
            $this->prefAdress = '';
            $this->prefCity = '';
            $this->prefUF = '';
            $this->prefContact = '';
            $this->prefMayor = '';
            $this->prefPhone = '';
            $this->prefEmail = '';

        } catch(Exception $e) {
            dd($e->getMessage());
        }

    }
}
