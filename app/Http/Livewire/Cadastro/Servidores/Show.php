<?php

namespace App\Http\Livewire\Cadastro\Servidores;

use App\Models\Secretaria;
use App\Models\Servidor;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public ?int $secId = null;
    public ?string $secName = null;

    protected $listeners = [
        'servidor created' => 'refresh',
        'servidor updated' => 'refresh',
        'servidor deleted' => 'refresh',
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
        $query = $this->secId != null ? Servidor::where('secretaria_id', $this->secId)->paginate(15) : Servidor::paginate(15);

        return view('livewire.cadastro.servidores.show', ['servidores' => $query]);
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

    public function refresh()
    {
        $this->resetPage();
    }
}
