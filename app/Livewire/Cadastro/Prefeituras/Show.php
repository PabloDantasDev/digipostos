<?php

namespace App\Livewire\Cadastro\Prefeituras;

use App\Models\Prefeitura;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'prefeitura created' => 'refresh',
        'prefeitura updated' => 'refresh',
        'prefeitura deleted' => 'refresh',
    ];

    public function render()
    {
        return view('livewire.cadastro.prefeituras.show', ['prefeituras' => Prefeitura::paginate(15)]);
    }

    public function choosePrefeitura($prefId)
    {
        $this->emitUp('choose prefeitura', $prefId);
    }
    
    public function refresh()
    {
        $this->resetPage();
    }
}
