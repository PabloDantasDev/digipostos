<?php 

namespace App\UseCases\Combustivel;

use App\Models\Combustivel;
use Exception;

class DeleteCombustivelUseCase 
{
    public function execute(int $combustivel_id) : bool
    {
        $combustivel = Combustivel::find($combustivel_id);

        if(!$combustivel)
        {
            throw new Exception('Erro! Combustível não encontrado.');
            return false;
        }

        $deleted_combustivel = $combustivel->delete();

        if (!$deleted_combustivel) {
            throw new Exception('Erro! Falha em deletar o combustível.');
            return false;
        }
        
        return true;
    }
}