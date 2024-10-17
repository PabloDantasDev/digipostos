<?php 

namespace App\UseCases\Funcionario;

use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class UpdateFuncionarioUseCase
{

    private array $rules = [ 
        'name' => 'required',
        'cellphone' => 'required',
        'email'=> 'required|email',
        'password' => 'required|min:6',
        'terms' => 'required',
    ];

    private array $messages = [
        'name' => 'Nome inválido!',
        'cellphone' => 'Celular inválido!',
        'email'=> 'Email inválido!',
        'password' => 'Senha inválida!',
        'terms' => 'Termo de uso inválido!',
    ];

    public function execute(int $funcId, array $data): Funcionario
    {
        $this->validate($data, $funcId);
        
        $funcionario = Funcionario::find($funcId);

        $useCase = new UpdateFuncionarioUserUseCase;

        if (!$funcionario) {
            throw new Exception('Erro! Funcionario não encontrado.');
        }

        $funcionario->name = $data['name'];
        $funcionario->phone = $data['phone'];
        $funcionario->cellphone = $data['cellphone'];
        $funcionario->email = $data['email'];
        $funcionario->password = Hash::make($data['password']);
        $funcionario->terms = $data['terms'];

        $useCase->execute($funcId, $data);

        $funcionario->save();
        
        return $funcionario;
    }

    private function validate(array $data, $funcId) : bool
    {
        $validator = Validator::make($data, $this->rules , $this->messages);
        if( $validator->fails() )
        {
            $firstError = $validator->errors()->first();
            throw new Exception('Erro! ' . $firstError);
            return false;
        }

        $emailValidation = Funcionario::where('email', $data['email'])->get()->first();

        if ($emailValidation && $emailValidation->id != $funcId) {
            throw new Exception('Erro! Email em uso!');
            return false;
        }

        return true;
    }
}