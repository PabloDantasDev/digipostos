<?php 

namespace App\UseCases\Credito;

use App\Models\Credito;
use Illuminate\Support\Facades\Validator;
use Exception;

class SubtractCreditoUseCase
{
    private array $rules = [ 
        'fuel_credit' => 'required|numeric',
        'value' => 'required|numeric',
    ];

    private array $messages = [
        'value' => 'Valor inválido! Insira um valor válido para continuar.',
        'fuel_credit' => 'Valor inválido! Insira um valor válido para continuar.',
    ];

    public function execute(int $credId, array $data): Credito
    {
        $this->validate($data);
        
        $credito = Credito::find($credId);

        if (!$credito) {
            throw new Exception('Erro! Cadastro do Crédito não encontrado.');
        }

        if( date('Y-m-d') > $credito->validity) {
            throw new Exception('Erro! Fora da validade!');
        }

        if ($data['fuel_credit'] > $credito->fuel_credit || $data['fuel_credit'] > $credito->veiculo->tank_capacity) {
            throw new Exception('Erro! Não é possivel subtrair essa quantidade!');
        }

        $credito->value -= $data['value'];
        $credito->fuel_credit -= $data['fuel_credit'];

        $credito->save();
        
        return $credito;
    }

    private function validate(array $data) : bool
    {
        $validator = Validator::make($data, $this->rules , $this->messages);
        if( $validator->fails() )
        {
            $firstError = $validator->errors()->first();
            throw new Exception('Erro! ' . $firstError);
            return false;
        }

        return true;
    }

}