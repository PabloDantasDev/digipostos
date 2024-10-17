<?php 

namespace App\UseCases\Baixa;

use App\Models\Baixa;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreateBaixaUseCase
{
    public function execute(int $baixaId): bool
    {
        $baixa = Baixa::find($baixaId);
    
        if (!$baixa) {
            throw new Exception('Erro! Cadastro da Baixa não encontrado.');
            return false;
        }
    
        $deletedBaixa = $baixa->delete();
    
        if (!$deletedBaixa) {
            throw new Exception('Erro! Falha em deletar a baixa do crédito.');
            return false;
        }
        
        return true;
    }
    

}