<?php 

namespace App\UseCases\Servidor;

use App\Models\Servidor;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeleteServidorUseCase
{

    public function execute(int $servId): bool
    {
        
        $servidor = Servidor::find($servId);

        if (!$servidor) {
            throw new Exception('Erro! Servidor não encontrado.');
            return false;
        }

        $deletedServ = $servidor->delete();

        if (!$deletedServ) {
            throw new Exception('Erro! Falha em deletar o Servidor.');
            return false;
        }
        
        return true;
    }

}