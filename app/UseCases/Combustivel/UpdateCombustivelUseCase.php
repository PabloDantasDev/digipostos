<?php 

namespace App\UseCases\Combustivel;

use App\Models\Combustivel;
use Exception;
use Illuminate\Support\Facades\Validator;

class UpdateCombustivelUseCase 
{
    private array $rules = [ 
        'name' => 'required|max:50',
    ];

    private array $messages = [
        'name' => 'Nome inválido!',
    ];

    public function execute(int $combustivel_id, array $data) : Combustivel
    {
        $this->validate($data);

        $combustivel = Combustivel::find($combustivel_id);

        if (!$combustivel)
        {
            throw new Exception('Erro! Combustível não encontrado.');
        }

        $combustivel->update($data);

        return $combustivel;
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