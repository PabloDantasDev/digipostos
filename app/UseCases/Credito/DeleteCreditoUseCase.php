<?php 

namespace App\UseCases\Credito;

use App\Models\Credito;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeleteCreditoUseCase
{

    public function execute(int $credId): bool
    {
        
        $credito = Credito::find($credId);

        if (!$credito) {
            throw new Exception('Erro! Cadastro do Crédito não encontrado.');
            return false;
        }

        $deletedCred = $credito->delete();

        if (!$deletedCred) {
            throw new Exception('Erro! Falha em deletar o cadastro do Crédito.');
            return false;
        }
        
        return true;
    }

}