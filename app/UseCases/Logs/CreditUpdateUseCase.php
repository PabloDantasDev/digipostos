<?php 

namespace App\UseCases\Logs;

use App\Models\CreditUpdate;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreditUpdateUseCase
{

    private array $rules = [ 
        'credito_id' => 'required|exists:creditos,id',
        'user_id' => 'required|exists:users,id',
        'old_value' => 'required|numeric',
        'new_value' => 'required|numeric',
        'old_fuel' => 'required|numeric',
        'new_fuel' => 'required|numeric',
        'old_validity' => 'required',
        'new_validity' => 'required',
    ];

    private array $messages = [
        'credito_id' => 'Crédito invaálido!',
        'user_id' => 'Usuário inválido!',
        'old_value' => 'Preço inválido!',
        'new_value' => 'Novo preço inválido!',
        'old_fuel' => 'Combustível inválido!',
        'new_fuel' => 'Novo combustível inválido!',
        'old_validity' => 'Validade Inválida!',
        'new_validity' => 'Nova validade inválida!',
    ];

    public function execute(array $data) : bool
    {
        $this->validate($data);
        
        $log = CreditUpdate::create($data);
        
        return true;
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