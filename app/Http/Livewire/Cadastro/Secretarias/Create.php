<?php

namespace App\Http\Livewire\Cadastro\Secretarias;

use App\Models\Prefeitura;
use App\UseCases\Secretaria\CreateSecretariaUseCase;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $prefeituras;
    public $selectedPrefeitura;
    public string $secName = '';

    public function mount( ?int $prefId )
    {
        $this->prefeituras = Prefeitura::all();
        $this->selectedPrefeitura = $prefId;
    }
    
    public function render()
    {
        return view('livewire.cadastro.secretarias.create');
    }

    public function saveSecretaria()
    {
        try {

            $data = [

                'name' => $this->secName,
                'prefeitura_id' => $this->selectedPrefeitura,
    
            ];
            $useCase = new CreateSecretariaUseCase;
    
            $useCase->execute($data);

            $this->emitUp('secretaria created');
            $this->emitTo('flash-message', 'flashMessage', 'Secertaria cadastrada com sucesso!');

            $this->secName = '';
            $this->selectedPrefeitura = '';
            
        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
