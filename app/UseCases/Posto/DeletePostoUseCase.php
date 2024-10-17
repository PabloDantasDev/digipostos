<?php 

namespace App\UseCases\Posto;

use App\Models\Posto;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeletePostoUseCase
{

    public function execute(int $postoId): bool
    {
        
        $posto = Posto::find($postoId);

        if (!$posto) {
            throw new Exception('Erro! Posto não encontrado.');
            return false;
        }

        $deletedPosto = $posto->delete();

        if (!$deletedPosto) {
            throw new Exception('Erro! Falha em deletar o Posto.');
            return false;
        }
        
        return true;
    }

}