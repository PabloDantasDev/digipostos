<?php 

namespace App\UseCases\Combustivel;

use App\Models\Combustivel;
use Exception;
use Illuminate\Support\Facades\Validator;

class CreateCombustivelUseCase 
{
    private array $rules = [ 
        'name' => 'required|max:50',
    ];

    private array $messages = [
        'name' => 'Nome inválido!',
    ];

    public function execute(array $data) : Combustivel
    {
        $this->validate($data);

        $combustivel = Combustivel::create($data);

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