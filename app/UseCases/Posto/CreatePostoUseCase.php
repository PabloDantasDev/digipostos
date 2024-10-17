<?php 

namespace App\UseCases\Posto;

use App\Models\Posto;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreatePostoUseCase
{

    private array $rules = [ 
        'name' => 'required|max:50',
        'adress' => 'required',
        'cnpj' => 'required|max:20',
        'inscription' => 'required',
        'city' => 'required',
        'uf' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
    ];

    private array $messages = [
        'name' => 'Nome inválido!',
        'adress' => 'Endereço inválido!',
        'cnpj' => 'CNPJ inválido!',
        'inscription' => 'Número de inscrição inválido!',
        'city' => 'Nome da cidade inválido!',
        'uf' => 'Estado inválido!',
        'phone' => 'Telefone inválido!',
        'email' => 'Email inválido!',
    ];

    public function execute(array $data): Posto
    {
        $this->validate($data);
        
        $posto = Posto::create($data);
        
        return $posto;
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