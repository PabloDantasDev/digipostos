<?php 

namespace App\UseCases\Servidor;

use App\Models\Servidor;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreateServidorUseCase
{

    private array $rules = [ 
        'name' => 'required',
        'cpf' => 'required|max:15',
        'rg' => 'required',
        'sex' => 'required',
        'secretaria_id' => 'required|exists:secretarias,id',
        'cellphone' => 'required',
        'email'=> 'required|email|unique:servidores,email|unique:users,email',
        'password' => 'required|min:8',
        'terms' => 'required',
        'veiculo_id' => 'required|exists:veiculos,id',
    ];

    private array $messages = [
        'name' => 'Nome inválido!',
        'cpf' => 'CPF inválido!',
        'rg' => 'RG inválido!',
        'sex' => 'Sexo inválido!',
        'secretaria_id' => 'Secretaria inválida!',
        'cellphone' => 'Celular inválido!',
        'email'=> 'Email inválido!',
        'password' => 'Senha inválida!',
        'terms' => 'Termo de uso inválido!',
        'veiculo_id' => 'Veículo inválido!',
    ];

    public function execute(array $data): Servidor
    {
        $this->validate($data);
        
        $servidor = Servidor::create($data);

        $registerUseCase = new RegisterServidorUseCase;
        $registerData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'terms' => $data['terms'],
            'department_id' => $servidor->id,
        ];
        $registerUseCase->execute($registerData);
        
        return $servidor;
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