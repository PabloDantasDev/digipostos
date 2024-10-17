<?php

namespace App\Http\Livewire\Cadastro\Prefeituras;

use App\Models\Prefeitura;
use App\UseCases\Prefeitura\DeletePrefeituraUseCase;
use App\UseCases\Prefeitura\UpdatePrefeituraUseCase;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    
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
    public $prefLogo;

    public $imageFile;
    
    public $user;
    public $prefPassword;
    
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
    $this->prefLogo = $prefeitura->logo;

    $this->prefPassword = $prefeitura->password;
    $this->user = Auth::user();
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
                'logo' => $this->imageFile,
            ];

            $useCase->execute($this->prefId, $data);

            $this->emitUp('prefeitura updated');
            $this->emitTo('flash-message', 'flashMessage', 'Prefeitura atualizada com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function deletePrefeitura()
    {
        try {

            $useCase = new DeletePrefeituraUseCase;

            $useCase->execute($this->prefId);

            $this->emitUp('prefeitura deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Prefeitura excluída com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
