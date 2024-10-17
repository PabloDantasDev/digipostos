<?php

namespace App\Http\Livewire\CadastroPostos\Combustivel;

use App\UseCases\Combustivel\CreateCombustivelUseCase;
use Exception;
use Livewire\Component;

class CombustivelCreate extends Component
{
    public $name;
    
    public function render()
    {
        return view('livewire.cadastro-postos.combustiveis.create');
    }

    public function create() : void
    {
        try {
            //code...
            $create_combustivel_use_case = new CreateCombustivelUseCase;
            
            $data = [
                'name' => $this->name
            ];

            $create_combustivel_use_case->execute($data);
    
            $this->emitUp('combustivel created');
            $this->emitTo('flash-message', 'flashMessage', 'Combustível cadastrado com sucesso!');
    
            $this->name = '';
        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
