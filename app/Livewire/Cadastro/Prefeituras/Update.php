<?php

namespace App\Livewire\Cadastro\Prefeituras;

use App\Models\Prefeitura;
use App\UseCases\Prefeitura\DeletePrefeituraUseCase;
use App\UseCases\Prefeitura\UpdatePrefeituraUseCase;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public int $prefId;
    public string $prefName;
    public string $prefCNPJ;
    public string $prefAdress;
    public string $prefCity;
    public string $prefUF;
    public string $prefContact;
    public string $prefMayor;
    public string $prefPhone;
    public string $prefEmail;
    
    public function mount(Prefeitura $prefeitura)
    {
        
    $this->prefId = $prefeitura->id;
    $this->prefName = $prefeitura->name;
    $this->prefCNPJ = $prefeitura->cnpj;
    $this->prefAdress = $prefeitura->adress;
    $this->prefCity = $prefeitura->city;
    $this->prefUF = $prefeitura->uf;
    $this->prefContact = $prefeitura->contact;
    $this->prefMayor = $prefeitura->mayor;
    $this->prefPhone = $prefeitura->phone;
    $this->prefEmail = $prefeitura->email;

    }
    
    public function render()
    {
        return view('livewire.cadastro.prefeituras.update');
    }

    public function updatePrefeitura() 
    {
        try {

            $useCase = new UpdatePrefeituraUseCase();

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

            $useCase->execute($this->prefId, $data);

            $this->emitUp('prefeitura updated');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function deletePrefeitura()
    {
        try {

            $useCase = new DeletePrefeituraUseCase;

            $useCase->execute($this->prefId);

            $this->emitUp('prefeitura deleted');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
