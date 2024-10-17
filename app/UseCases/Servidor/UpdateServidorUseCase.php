<?php 

namespace App\UseCases\Servidor;

use App\Models\Servidor;
use Illuminate\Support\Facades\Validator;
use Exception;

class UpdateServidorUseCase
{

    private array $rules = [ 
        'name' => 'required',
        'secretaria_id' => 'required|exists:secretarias,id',
        'cellphone' => 'required',
        'email'=> 'required|email',
        'password' => 'required|min:6',
        'terms' => 'required',
        'veiculo_id' => 'required|exists:veiculos,id',
    ];

    private array $messages = [
        'name' => 'Nome inválido!',
        'secretaria_id' => 'Secretaria inválida!',
        'cellphone' => 'Celular inválido!',
        'email'=> 'Email inválido!',
        'password' => 'Senha inválida!',
        'terms' => 'Termo de uso inválido!',
        'veiculo_id' => 'Veículo inválido!',
    ];

    public function execute(int $servId, array $data): Servidor
    {
        $this->validate($data, $servId);
        
        $servidor = Servidor::find($servId);

        $useCase = new UpdateServidorUserUseCase;
        
        if (!$servidor) {
            throw new Exception('Erro! Servidor não encontrado.');
        }

        $servidor->name = $data['name'];
        $servidor->secretaria_id = $data['secretaria_id'];
        $servidor->phone = $data['phone'];
        $servidor->cellphone = $data['cellphone'];
        $servidor->email = $data['email'];
        $servidor->password = $data['password'];
        $servidor->veiculo_id = $data['veiculo_id'];
        $servidor->terms = $data['terms'];

        $useCase->execute($servId, $data);
        
        $servidor->save();
        
        return $servidor;
    }

    private function validate(array $data, $servId) : bool
    {
        $validator = Validator::make($data, $this->rules , $this->messages);
        if( $validator->fails() )
        {
            $firstError = $validator->errors()->first();
            throw new Exception('Erro! ' . $firstError);
            return false;
        }

        $emailValidation = Servidor::where('email', $data['email'])->get()->first();

        if ($emailValidation && $emailValidation->id != $servId) {
            throw new Exception('Erro! Email em uso!');
            return false;
        }

        return true;
    }
}