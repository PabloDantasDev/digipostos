<?php

namespace App\Http\Livewire\CadastroPostos\Postos;

use App\Models\Posto;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'posto created' => 'refresh',
        'posto updated' => 'refresh',
        'posto deleted' => 'refresh',
    ];

    public function render()
    {
        return view('livewire.cadastro-postos.postos.show', ['postos' => Posto::paginate(15)]);
    }

    public function refresh()
    {
        $this->resetPage();
    }
}
