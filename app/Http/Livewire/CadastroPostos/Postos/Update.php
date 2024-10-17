<?php

namespace App\Http\Livewire\CadastroPostos\Postos;

use App\Models\Posto;
use App\UseCases\Posto\DeletePostoUseCase;
use App\UseCases\Posto\UpdatePostoUseCase;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public int $postoId;
    public $postoName;
    public $postoAdress;
    public $postoCNPJ;
    public $postoInsc;
    public $postoCity;
    public $postoUF;
    public $postoPhone;
    public $postoEmail;
    
    public function mount(Posto $posto)
    {
        
        $this->postoId = $posto->id;
        $this->postoName = $posto->name;
        $this->postoAdress = $posto->adress;
        $this->postoCNPJ = $posto->cnpj;
        $this->postoInsc = $posto->inscription;
        $this->postoCity = $posto->city;
        $this->postoUF = $posto->uf;
        $this->postoPhone = $posto->phone;
        $this->postoEmail = $posto->email;
        
    }
    
    public function render()
    {
        return view('livewire.cadastro-postos.postos.update');
    }
    
    public function updatePosto() 
    {
        try {
            
            $useCase = new UpdatePostoUseCase;

            $data = [
                'name' => $this->postoName,
                'adress' => $this->postoAdress,
                'cnpj' => $this->postoCNPJ,
                'inscription' => $this->postoInsc,
                'city' => $this->postoCity,
                'uf' => $this->postoUF,
                'mayor' => $this->postoPhone,
                'phone' => $this->postoPhone,
                'email' => $this->postoEmail,
            ];

            $useCase->execute($this->postoId, $data);

            $this->emitUp('posto updated');
            $this->emitTo('flash-message', 'flashMessage', 'Posto atualizado com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function deletePosto()
    {
        try {

            $useCase = new DeletePostoUseCase;

            $useCase->execute($this->postoId);

            $this->emitUp('posto deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Posto excluído com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
