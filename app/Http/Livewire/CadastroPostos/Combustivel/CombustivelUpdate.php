<?php

namespace App\Http\Livewire\CadastroPostos\Combustivel;

use App\Models\Combustivel;
use App\UseCases\Combustivel\DeleteCombustivelUseCase;
use App\UseCases\Combustivel\UpdateCombustivelUseCase;
use Exception;
use Livewire\Component;

class CombustivelUpdate extends Component
{
    public $combustivel_id;
    public $name;

    public function mount(Combustivel $combustivel)
    {
        
        $this->combustivel_id = $combustivel->id;
        $this->name = $combustivel->name;
    }

    public function render()
    {
        return view('livewire.cadastro-postos.combustiveis.update');
    }

    public function update()
    {
        try {
            $combustivel_update_use_case = new UpdateCombustivelUseCase;

            $data = [
                'name' => $this->name
            ];

            $combustivel_update_use_case->execute($this->combustivel_id, $data);

            $this->emitUp('combustivel updated');
            $this->emitTo('flash-message', 'flashMessage', 'Combustível atualizado com sucesso!');
        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function delete()
    {
        try {

            $useCase = new DeleteCombustivelUseCase;

            $useCase->execute($this->combustivel_id);

            $this->emitUp('combustivel deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Combustível excluído com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
