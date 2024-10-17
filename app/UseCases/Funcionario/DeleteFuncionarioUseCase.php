<?php 

namespace App\UseCases\Funcionario;

use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeleteFuncionarioUseCase
{

    public function execute(int $funcId): bool
    {
        
        $funcionario = Funcionario::find($funcId);

        if (!$funcionario) {
            throw new Exception('Erro! Funcionario não encontrado.');
            return false;
        }

        $deletedFunc = $funcionario->delete();

        if (!$deletedFunc) {
            throw new Exception('Erro! Falha em deletar o Funcionario.');
            return false;
        }
        
        return true;
    }

}