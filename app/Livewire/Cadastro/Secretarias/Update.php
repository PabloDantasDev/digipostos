<?php

namespace App\Livewire\Cadastro\Secretarias;

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

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function deleteSecretaria()
    {
        try {

            $useCase = new DeleteSecretariaUseCase;

            $useCase->execute($this->secId);

            $this->emitUp('secretaria deleted');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
