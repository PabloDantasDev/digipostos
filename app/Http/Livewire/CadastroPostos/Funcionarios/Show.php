<?php

namespace App\Http\Livewire\CadastroPostos\Funcionarios;

use App\Models\Funcionario;
use App\Models\Posto;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public ?int $postoId = null;
    public ?string $postoName = null;
    
    protected $listeners = [
        'funcionario created' => 'refresh',
        'funcionario updated' => 'refresh',
        'funcionario deleted' => 'refresh',
    ];
    
    public function mount(?int $postoId)
    {
        $this->postoId = $postoId;
        if ($postoId != null) {
            $this->postoName = Posto::find($postoId)->name;
        }
    }
    
    public function render()
    {
        $query = $this->postoId != null ? Funcionario::where('posto_id', $this->postoId)->paginate(15) : Funcionario::paginate(15);

        return view('livewire.cadastro-postos.funcionarios.show', ['funcionarios' => $query]);
    }
    
    public function choosePosto( $postoId = null )
    {
        try {

            $this->postoId = $postoId;
            if ($postoId != null) {
                $this->postoName = Posto::find($postoId)->name;
            }
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
