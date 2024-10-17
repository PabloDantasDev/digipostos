<?php 

namespace App\UseCases\Funcionario;

use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateFuncionarioUseCase
{

    private array $rules = [ 
        'name' => 'required',
        'cpf' => 'required|max:15',
        'rg' => 'required',
        'sex' => 'required',
        'posto_id' => 'required|exists:postos,id',
        'cellphone' => 'required',
        'email'=> 'required|email|unique:funcionarios,email|unique:users,email',
        'password' => 'required|min:8',
        'terms' => 'required',
    ];

    private array $messages = [
        'name' => 'Nome inválido!',
        'cpf' => 'CPF inválido!',
        'rg' => 'RG inválido!',
        'sex' => 'Sexo inválido!',
        'posto_id' => 'Posto inválido!',
        'cellphone' => 'Celular inválido!',
        'email'=> 'Email inválido!',
        'password' => 'Senha inválida!',
        'terms' => 'Termo de uso inválido!',
    ];

    public function execute(array $data): Funcionario
    {
        $this->validate($data);
        
        $funcionario = Funcionario::create($data);
        
        $registerUseCase = new RegisterFuncionarioUseCase;
        $registerData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'terms' => $data['terms'],
            'department_id' => $funcionario->id,
        ];
        $registerUseCase->execute($registerData);
        
        return $funcionario;
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