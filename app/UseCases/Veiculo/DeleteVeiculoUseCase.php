<?php 

namespace App\UseCases\Veiculo;

use App\Models\Veiculo;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeleteVeiculoUseCase
{

    public function execute(int $veicId): bool
    {
        
        $veiculo = Veiculo::find($veicId);

        if (!$veiculo) {
            throw new Exception('Erro! Veiculo não encontrado.');
            return false;
        }

        $deletedVeic = $veiculo->delete();

        if (!$deletedVeic) {
            throw new Exception('Erro! Falha em deletar o Veiculo.');
            return false;
        }
        
        return true;
    }

}