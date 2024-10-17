<?php 

namespace App\UseCases\Logs;

use App\Models\CreditUpdate;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeleteCreditUpdateUseCase
{

    public function execute(int $logId): bool
    {
        
        $CreditUpdate = CreditUpdate::find($logId);

        if (!$CreditUpdate) {
            throw new Exception('Erro! informações não encontradas.');
            return false;
        }

        $deletedLog = $CreditUpdate->delete();

        if (!$deletedLog) {
            throw new Exception('Erro! Falha em deletar a informação.');
            return false;
        }
        
        return true;
    }

}