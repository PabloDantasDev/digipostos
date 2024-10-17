<?php

namespace App\Http\Livewire\CadastroCreditos\Creditos;

use App\Models\Credito;
use App\Models\Posto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $postos;
    public $nextToDay;
    
    public $searchValue = '';

    protected $listeners = [
        'credito created' => 'refresh',
        'credito updated' => 'refresh',
        'credito deleted' => 'refresh',
        'atualizarValor'
    ];

    public function mount()
    {
        $this->postos = Posto::all();

        $this->nextToDay = Carbon::now()->startOfDay()->addDays(3);
    }
    
    // public function render()
    // {
    //     $query = Credito::query()->orderBy('creditos.id');
    //     if ($this->searchValue != null && $this->searchValue != '') {
    //         $query = $query->join('veiculos', 'creditos.veiculo_id', '=', 'veiculos.id')
    //         ->where('veiculos.license_plate', 'LIKE', '%'.$this->searchValue.'%');
    //     }
        
    //     $query = $query->paginate(15);
    //     return view('livewire.cadastro-creditos.creditos.show', ['creditos' => $query]);
    // }
    public function render()
    {
        $query = Credito::query()->orderBy('id');

        if ($this->searchValue != null && $this->searchValue != '') {
            $query = $query->whereExists(function ($subquery) {
                $subquery->select(DB::raw(1))
                    ->from('veiculos')
                    ->whereRaw('creditos.veiculo_id = veiculos.id')
                    ->where('veiculos.license_plate', 'LIKE', '%' . $this->searchValue . '%');
            });
        }

        $query = $query->paginate(15);
        return view('livewire.cadastro-creditos.creditos.show', ['creditos' => $query]);
    }

    public function atualizarValor($valor)
    {
        $this->searchValue = $valor;
        $this->gotoPage(1);
    }

    public function refresh()
    {
        $this->resetPage();
    }
}
