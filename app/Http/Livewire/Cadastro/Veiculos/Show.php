<?php

namespace App\Http\Livewire\Cadastro\Veiculos;

use App\Models\Secretaria;
use App\Models\Veiculo;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $maxPages = 2;
    
    public ?int $secId = null;
    public ?string $secName = null;

    public $searchValue = '';

    protected $listeners = [
        'veiculo created' => 'refresh',
        'veiculo updated' => 'refresh',
        'veiculo deleted' => 'refresh',
        'atualizarValor'
    ];

    public function mount(?int $secretariaId)
    {
        $this->secId = $secretariaId;
        if ($secretariaId != null) {
            $this->secName = Secretaria::find($secretariaId)->name;
        }
    }
    
    public function render()
    {
        $query = Veiculo::query()->orderBy('id');
        if($this->secId != null) {
            $query = $query->where('secretaria_id', $this->secId);
        } if ($this->searchValue != null && $this->searchValue != '') {
            $query = $query->where('license_plate', 'LIKE', '%'.$this->searchValue.'%');
        }
        
        $query = $query->paginate(15);
        return view('livewire.cadastro.veiculos.show', ['veiculos' => $query]);
    }

    public function chooseSecretaria( $secId = null )
    {
        try {

            $this->secId = $secId;
            if ($secId != null) {
                $this->secName = Secretaria::find($secId)->name;
            }
            $this->resetPage();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function atualizarValor($valor)
    {
        $this->gotoPage(1);
        $this->searchValue = $valor;
    }

    public function refresh()
    {
        $this->resetPage();
    }
}
