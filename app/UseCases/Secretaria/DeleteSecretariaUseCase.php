<?php 

namespace App\UseCases\Secretaria;

use App\Models\Secretaria;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeleteSecretariaUseCase
{

    public function execute(int $secId): bool
    {
        
        $secretaria = Secretaria::find($secId);

        if (!$secretaria) {
            throw new Exception('Erro! Secretaria não encontrada.');
            return false;
        }

        $deletedSec = $secretaria->delete();

        if (!$deletedSec) {
            throw new Exception('Erro! Falha em deletar a Secretaria.');
            return false;
        }
        
        return true;
    }

}