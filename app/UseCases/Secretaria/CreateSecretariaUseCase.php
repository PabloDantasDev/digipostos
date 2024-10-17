<?php 

namespace App\UseCases\Secretaria;

use App\Models\Secretaria;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreateSecretariaUseCase
{

    private array $rules = [ 
        'name' => 'required|min:5|max:50',
        'prefeitura_id' => 'required|exists:prefeituras,id',
    ];

    private array $messages = [
        'name' => 'Nome da Secretaria inválido!',
        'prefeitura_id' => 'Prefeitura não existe!',
    ];

    public function execute(array $data): Secretaria
    {
        $this->validate($data);
        
        $secretaria = Secretaria::create($data);
        
        return $secretaria;
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