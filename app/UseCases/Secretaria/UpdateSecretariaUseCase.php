<?php 

namespace App\UseCases\Secretaria;

use App\Models\Secretaria;
use Illuminate\Support\Facades\Validator;
use Exception;

class UpdateSecretariaUseCase
{

    private array $rules = [ 
        'name' => 'required|min:5|max:50',
    ];

    private array $messages = [
        'name' => 'Nome da prefeitura inválido!',
    ];

    public function execute(int $secId, array $data): Secretaria
    {
        $this->validate($data, $secId);
        
        $secretaria = Secretaria::find($secId);

        if (!$secretaria) {
            throw new Exception('Erro! Secretaria não encontrada.');
        }

        $secretaria->name = $data['name'];
        $secretaria->save();
        
        return $secretaria;
    }

    private function validate(array $data, $prefId) : bool
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