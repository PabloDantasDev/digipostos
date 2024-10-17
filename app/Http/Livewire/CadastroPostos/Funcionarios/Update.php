<?php

namespace App\Http\Livewire\CadastroPostos\Funcionarios;

use App\Models\Funcionario;
use App\UseCases\Funcionario\DeleteFuncionarioUseCase;
use App\UseCases\Funcionario\UpdateFuncionarioUseCase;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public int $funcId;
    
    public $funcName;
    public $funcPhone;
    public $funcCellphone;
    public $funcEmail;
    public $funcPassword;
    public $funcTerms;
    
    public function mount(Funcionario $funcionario)
    {
        
        $this->funcId = $funcionario->id;
        
        $this->funcName = $funcionario->name;
        $this->funcPhone = $funcionario->phone;
        $this->funcCellphone = $funcionario->cellphone;
        $this->funcEmail = $funcionario->email;
        $this->funcTerms = $funcionario->terms;
        
    }
    
    public function render()
    {
        return view('livewire.cadastro-postos.funcionarios.update');
    }
    
    public function updateFuncionario() 
    {
        try {

            $useCase = new UpdateFuncionarioUseCase;

            $data = [
                'name' => $this->funcName,
                'phone' => $this->funcPhone,
                'cellphone' => $this->funcCellphone,
                'email'=> $this->funcEmail,
                'password' => $this->funcPassword,
                'terms' => $this->funcTerms,
            ];

            $useCase->execute($this->funcId, $data);

            $this->emitUp('funcionario updated');
            $this->emitTo('flash-message', 'flashMessage', 'Funcionário atualizado com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function deleteFuncionario()
    {
        try {

            $useCase = new DeleteFuncionarioUseCase;
            $useCase->execute($this->funcId);

            $this->emitUp('funcionario deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Funcionário excluído com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
