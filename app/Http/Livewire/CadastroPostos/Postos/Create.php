<?php

namespace App\Http\Livewire\CadastroPostos\Postos;

use App\UseCases\Posto\CreatePostoUseCase;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $postoName;
    public $postoAdress;
    public $postoCNPJ;
    public $postoInsc;
    public $postoCity;
    public $postoUF;
    public $postoPhone;
    public $postoEmail;

    public function render()
    {
        return view('livewire.cadastro-postos.postos.create');
    }

    
    public function createPosto() : void
    {
        try {
            $useCase = new CreatePostoUseCase;

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

            $useCase->execute($data);

            $this->emitUp('posto created');
            $this->emitTo('flash-message', 'flashMessage', 'Posto cadastrado com sucesso!');

            
            $this->postoName = '';
            $this->postoAdress = '';
            $this->postoCNPJ = '';
            $this->postoInsc = '';
            $this->postoCity = '';
            $this->postoUF = '';
            $this->postoPhone = '';
            $this->postoEmail = '';

        } catch(Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }

    }
}
