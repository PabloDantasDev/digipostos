<?php

namespace App\Http\Livewire\CadastroPostos\Funcionarios;

use App\Models\Posto;
use App\UseCases\Funcionario\CreateFuncionarioUseCase;
use Exception;
use Livewire\Component;

class Create extends Component
{
    public $postos;
    public $selectedPosto = '';
    
    public $funcName;
    public $funcCPF;
    public $funcRG;
    public $funcSex;
    public $funcPhone;
    public $funcCellphone;
    public $funcEmail;
    public $funcPassword;
    public $funcTerms;
    
    public function mount()
    {
        $this->postos = Posto::all();
    }
    
    public function render()
    {
        return view('livewire.cadastro-postos.funcionarios.create');
    }
    
    public function createFuncionario() : void
    {
        try {
            $useCase = new CreateFuncionarioUseCase;
            
            $data = [
               
                'name' => $this->funcName,
                'cpf' => $this->funcCPF,
                'rg' => $this->funcRG,
                'sex' => $this->funcSex,
                'posto_id' => $this->selectedPosto,
                'phone' => $this->funcPhone,
                'cellphone' => $this->funcCellphone,
                'email'=> $this->funcEmail,
                'password' => $this->funcPassword,
                'terms' => $this->funcTerms,

            ];

            $useCase->execute($data);

            $this->emitUp('funcionario created');
            $this->emitTo('flash-message', 'flashMessage', 'Funcionário cadastrado com sucesso!');

            
            $this->funcName = '';
            $this->funcCPF = '';
            $this->funcRG = '';
            $this->funcSex = '';
            $this->funcPhone = '';
            $this->funcCellphone = '';
            $this->funcEmail = '';
            $this->funcPassword = '';
            $this->funcTerms = '';

            $this->selectedPosto = '';

        } catch(Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }

    }
}
