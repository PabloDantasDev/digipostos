<?php 

namespace App\UseCases\Baixa;

use App\Models\Baixa;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreateBaixaUseCase
{

    private array $rules = [ 
        'liters' => 'required|numeric',
        'value' => 'required|numeric',
        'veiculo_id' => 'required|exists:veiculos,id',
        'funcionario_id' => 'required|exists:funcionarios,id',
    ];

    private array $messages = [
        'liters' => 'Quantidade em litros inválida!',
        'value' => 'Valor inválido!',
        'veiculo_id' => 'Veículo inválido',
        'funcionario_id' => 'required',
    ];

    public function execute(array $data): Baixa
    {
        $this->validate($data);
        
        $credito = Baixa::create($data);
        
        return $credito;
    }

    private function validate(array $data) : bool
    {
        $validator = Validator::make($data, $this->rules , $this->messages);
        if( $validator->fails() )
        {
            $firstError = $validator->errors()->first();
            // throw new Exception('Erro! ' . $firstError);
            throw new Exception('Erro! crédito debitado com problema no relatório: ' . $firstError);
            return false;
        }

        return true;
    }
}