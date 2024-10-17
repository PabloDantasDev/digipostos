<?php 

namespace App\UseCases\Credito;

use App\Models\Combustivel;
use App\Models\Credito;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreateCreditoUseCase
{

    private array $rules = [ 
        'value' => 'required|numeric',
        'fuel' => 'nullable',
        'value_per_liter' => 'required|numeric',
        'veiculo_id' => 'required|exists:veiculos,id',
        'posto_id' => 'required|exists:postos,id',
        'validity' => 'required',
        'fuel_credit' => 'required|numeric',
        'combustivel_id' => 'required|exists:combustivels,id',
    ];

    private array $messages = [
        'value' => 'Valor inválido!',
        'fuel' => 'Tipo do combustível inválido!',
        'value_per_liter' => 'Valor por litro inválido!',
        'veiculo_id' => 'Veículo inválido!',
        'posto_id' => 'Posto inválido!',
        'validity' => 'Validade inválida!',
        'fuel_credit' => 'Créditos em litros inválido!',
        'combustivel_id' => 'Combustível inválido!',
    ];

    public function execute(array $data): Credito
    {
        $this->validate($data);

        if(!array_key_exists('fuel', $data))
        {
            $combustivel  = Combustivel::find($data['combustivel_id']);
            $data['fuel'] = $combustivel->name;
        }
        
        $credito = Credito::create($data);
        
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