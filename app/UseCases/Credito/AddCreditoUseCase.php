<?php 

namespace App\UseCases\Credito;

use App\Models\Credito;
use App\UseCases\Logs\CreditUpdateUseCase;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class AddCreditoUseCase
{

    private array $rules = [ 
        'fuel_credit' => 'numeric',
        'value' => 'numeric',
        'validity' => 'date',
    ];

    private array $messages = [
        'fuel_credit' => 'valor inválido! Insira um valor válido para continuar.',
        'value' => 'valor inválido! Insira um valor válido para continuar.',
        'validity' => 'data de validade incompatível.',
    ];

    public function execute(int $credId, array $data): Credito
    {
        $credito = Credito::find($credId);

        if (!$credito) {
            throw new Exception('Erro! Cadastro do Crédito não encontrado.');
        }

        if(!isset($data['fuel_credit']) || $data['fuel_credit'] == '') {
            $data['fuel_credit'] = 0;
            $data['value'] = 0;
        }
        if(!isset($data['validity']) || $data['validity'] == '') {
            $data['validity'] = $credito->validity;
        }
        
        $this->validate($data);
        

        $useCase = new CreditUpdateUseCase;
        $logData = [
            'credito_id' => $credito->id,
            'user_id' => Auth::user()->id,
            'datetime' => now(),
            'old_value' => $credito->value,
            'new_value' => $data['value'],
            'old_fuel' => $credito->fuel_credit,
            'new_fuel' => $data['fuel_credit'],
            'old_validity' => $credito->validity,
            'new_validity' => $data['validity'],
        ];
        $logCreated = $useCase->execute($logData);
        if (!$logCreated) {
            throw new Exception('Erro no salvamento de dados.');
        }

        $credito->value += $data['value'];
        $credito->fuel_credit += $data['fuel_credit'];
        $credito->validity = $data['validity'];
        
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