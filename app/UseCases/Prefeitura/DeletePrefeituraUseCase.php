<?php 

namespace App\UseCases\Prefeitura;

use App\Models\Prefeitura;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeletePrefeituraUseCase
{

    public function execute(int $prefId): bool
    {
        
        $prefeitura = Prefeitura::find($prefId);

        if (!$prefeitura) {
            throw new Exception('Erro! Prefeitura não encontrada.');
            return false;
        }

        $deletedPref = $prefeitura->delete();

        if (!$deletedPref) {
            throw new Exception('Erro! Falha em deletar a Prefeitura.');
            return false;
        }
        
        return true;
    }

}