<?php

namespace App\Http\Livewire\Cadastro\Servidores;

use App\Models\Secretaria;
use App\Models\Servidor;
use App\Models\Veiculo;
use App\UseCases\Servidor\DeleteServidorUseCase;
use App\UseCases\Servidor\UpdateServidorUseCase;
use Exception;
use Livewire\Component;

class Update extends Component
{
    public $selectedSecretaria;
    public $selectedVeiculo;
    public $secretarias;
    public $veiculos;

    public int $servId;

    public $servName;
    public $servPhone;
    public $servCellphone;
    public $servEmail;
    public $servPassword;
    public $servTerms;
    
    public function mount(Servidor $servidor)
    {
        
        $this->servId = $servidor->id;
        
        $this->servName = $servidor->name;
        $this->servPhone = $servidor->phone;
        $this->servCellphone = $servidor->cellphone;
        $this->servEmail = $servidor->email;
        $this->servPassword = $servidor->password;
        $this->servTerms = $servidor->terms;

        $this->secretarias = Secretaria::all();
        $this->selectedSecretaria = $servidor->secretaria->id;
        $this->veiculos = Veiculo::where('secretaria_id', $this->selectedSecretaria)->get();
        $this->selectedVeiculo = $servidor->veiculo->id;

    }
    
    public function render()
    {
        return view('livewire.cadastro.servidores.update');
    }

    public function refreshVeiculos() 
    {
            $this->veiculos = Veiculo::where('secretaria_id', $this->selectedSecretaria)->get();
    }

    public function updateServidor() 
    {
        try {

            $useCase = new UpdateServidorUseCase;

            $data = [
                'name' => $this->servName,
                'secretaria_id' => $this->selectedSecretaria,
                'phone' => $this->servPhone,
                'cellphone' => $this->servCellphone,
                'email'=> $this->servEmail,
                'password' => $this->servPassword,
                'terms' => $this->servTerms,
                'veiculo_id' => $this->selectedVeiculo,
            ];

            $useCase->execute($this->servId, $data);

            $this->emitUp('servidor updated');
            $this->emitTo('flash-message', 'flashMessage', 'Servidor atualizado com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }

    public function deleteServidor()
    {
        try {

            $useCase = new DeleteServidorUseCase;

            $useCase->execute($this->servId);

            $this->emitUp('servidor deleted');
            $this->emitTo('flash-message', 'flashMessage', 'Servidor excluído com sucesso!');

        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
