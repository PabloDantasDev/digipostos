<?php

namespace App\Livewire\Cadastro\Secretarias;

use App\Models\Prefeitura;
use App\Models\Secretaria;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    
    public ?int $prefId = null;

    protected $listeners = [
        'secretaria created' => 'refresh',
        'secretaria updated' => 'refresh',
        'secretaria deleted' => 'refresh',
    ];

    public function mount(?int $prefeituraId)
    {
        $this->prefId = $prefeituraId;
    }
    
    public function render()
    {
        $query = $this->prefId != null ? Secretaria::where('prefeitura_id', $this->prefId)->paginate(15) : Secretaria::paginate(15);

        return view('livewire.cadastro.secretarias.show', ['secretarias' => $query]);
    }

    public function choosePrefeitura( $prefId = null )
    {
        try {

            $this->prefId = $prefId;
            $this->resetPage();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function refresh()
    {
        $this->resetPage();
    }
}
