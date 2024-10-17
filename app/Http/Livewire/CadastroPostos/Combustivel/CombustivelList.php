<?php

namespace App\Http\Livewire\CadastroPostos\Combustivel;

use App\Models\Combustivel;
use Livewire\Component;
use Livewire\WithPagination;

class CombustivelList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'combustivel created' => 'refresh',
        'combustivel updated' => 'refresh',
        'combustivel deleted' => 'refresh',
    ];

    public function render()
    {
        return view('livewire.cadastro-postos.combustiveis.list', ['combustiveis' => Combustivel::paginate(15)]);
    }

    public function refresh()
    {
        $this->resetPage();
    }
}
