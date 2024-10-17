<?php 

namespace App\UseCases\Credito;

use App\Models\Combustivel;
use App\Models\Credito;
use App\UseCases\Logs\CreditUpdateUseCase;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class UpdateCreditoUseCase
{

    private array $rules = [ 
        'value' => 'required|numeric',
        'fuel' => 'nullable',
        'value_per_liter' => 'required|numeric',
        'posto_id' => 'required|exists:postos,id',
        'validity' => 'required',
        'fuel_credit' => 'required|numeric',
        'combustivel_id' => 'required|exists:combustivels,id',
    ];

    private array $messages = [
        'value' => 'Valor inválido!',
        'fuel' => 'Tipo do combustível inválido!',
        'value_per_liter' => 'Valor por litro inválido!',
        'posto_id' => 'Posto inválido!',
        'validity' => 'Validade inválida!',
        'fuel_credit' => 'Créditos em litros inválido!',
        'combustivel_id' => 'Combustível inválido!',
    ];

    public function execute(int $credId, array $data): Credito
    {
        $this->validate($data);
        
        $credito = Credito::find($credId);

        if (!$credito) {
            throw new Exception('Erro! Cadastro do Crédito não encontrado.');
        }

        if(!array_key_exists('fuel', $data))
        {
            $combustivel  = Combustivel::find($data['combustivel_id']);
            $credito->fuel = $combustivel->name;
        } else {
            $credito->fuel = $data['fuel'];
        }
        
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
        
        $credito->value = $data['value'];
        $credito->value_per_liter = $data['value_per_liter'];
        $credito->posto_id = $data['posto_id'];
        $credito->validity = $data['validity'];
        $credito->fuel_credit = $data['fuel_credit'];
        $credito->combustivel_id = $data['combustivel_id'];

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