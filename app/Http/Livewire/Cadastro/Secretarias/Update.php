<?php

namespace App\Http\Livewire\Cadastro\Secretarias;

use App\Models\Secretaria;
use App\UseCases\Secretaria\DeleteSecretariaUseCase;
use App\UseCases\Secretaria\UpdateSecretariaUseCase;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public int $secId;
    public string $secName;
    public int $secPrefId;
    
    public function mount(Secretaria $secretaria)
    {
        
        $this->secId = $secretaria->id;
        $this->secName = $secretaria->name;
        
    }
    
    public function render()
    {
        return view('livewire.cadastro.secretarias.update');
    }

    public function updateSecretaria() 
    {
        try {

            $useCase = new UpdateSecretariaUseCase;

            $data = [
                'name' => $this->secName,
            ];

            $useCase->execute($this->secId, $data);

            $this->emitUp('secretaria updated');
            $this->emitTo('flash-message', 'flashMessage', 'secretaria atualizada com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function deleteSecretaria()
    {
        try {

            $useCase = new DeleteSecretariaUseCase;

            $useCase->execute($this->secId);

            $this->emitUp('secretaria deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Secretaria excluída com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
