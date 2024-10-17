<?php 

namespace App\UseCases\Prefeitura;

use App\Models\Prefeitura;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreatePrefeituraUseCase
{

    private array $rules = [ 
        'name' => 'required|min:5|max:50',
        'cnpj' => 'required|unique:prefeituras,cnpj',
        'adress' => 'required|min:5|max:100',
        'city' => 'required|min:3|max:50',
        'uf' => 'required|min:2',
        'contact' => 'required',
        'mayor' => 'required|min:5|max:50',
        'phone' => 'required',
        'email' => 'required|email|unique:prefeituras,email',
        'password' => 'required|min:6'
        // @TODO create logo validation
    ];

    private array $messages = [
        'name' => 'Nome da prefeitura inválido!',
        'cnpj' => 'CNPJ invállido!',
        'adress' => 'Endereço inválido!',
        'city' => 'Cidade inválida!',
        'uf' => 'UF inválida!',
        'contact' => 'Contato inválido!',
        'mayor' => 'Prefeito inválido!',
        'phone' => 'Número de telefone inválido!',
        'email' => 'Email inválido!',
        'password' => 'A senha é obrigatória e deve conter no mínimo 4 caracteres!'
    ];

    public function execute(array $data): Prefeitura
    {
        $this->validate($data);
        
        if (!isset($data['logo']) || !$data['logo']) {
            $prefeitura = Prefeitura::create($data);
        } else {
            $prefeitura = new Prefeitura;

            $prefeitura->name = $data['name'];
            $prefeitura->cnpj = $data['cnpj'];
            $prefeitura->adress = $data['adress'];
            $prefeitura->city = $data['city'];
            $prefeitura->uf = $data['uf'];
            $prefeitura->contact = $data['contact'];
            $prefeitura->mayor = $data['mayor'];
            $prefeitura->phone = $data['phone'];
            $prefeitura->email = $data['email'];
            $prefeitura->password = $data['password'];

            $addLogoUseCase = new AddLogoUseCase;
            $prefeitura = $addLogoUseCase->execute($prefeitura, $data['logo']);

            $prefeitura->save();
        }
        
        return $prefeitura;
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