<?php 

namespace App\UseCases\Prefeitura;

use App\Models\Prefeitura;
use Illuminate\Support\Facades\Validator;
use Exception;

class UpdatePrefeituraUseCase
{

    private array $rules = [ 
        'name' => 'required|min:5|max:50',
        'cnpj' => 'required',
        'adress' => 'required|min:5|max:100',
        'city' => 'required|min:3|max:50',
        'uf' => 'required|min:2',
        'contact' => 'required',
        'mayor' => 'required|min:5|max:50',
        'phone' => 'required',
        'email' => 'required|email',
        // @TODO logo validation
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
    ];

    public function execute(int $prefId, array $data): Prefeitura
    {
        $this->validate($data, $prefId);
        
        $prefeitura = Prefeitura::find($prefId);

        if (!$prefeitura) {
            throw new Exception('Erro! Prefeitura não encontrada.');
        }

        $prefeitura->name = $data['name'];
        $prefeitura->cnpj = $data['cnpj'];
        $prefeitura->adress = $data['adress'];
        $prefeitura->city = $data['city'];
        $prefeitura->uf = $data['uf'];
        $prefeitura->contact = $data['contact'];
        $prefeitura->mayor = $data['mayor'];
        $prefeitura->phone = $data['phone'];
        $prefeitura->email = $data['email'];

        if ($data['logo'] != '' || $data['logo'] != null) {
            $removeLogoUseCase = new RemoveLogoUseCase;
            $addLogoUseCase = new AddLogoUseCase;
           
            $prefeitura = $removeLogoUseCase->execute($prefeitura);
            $prefeitura = $addLogoUseCase->execute($prefeitura, $data['logo']);
        }
        
        $prefeitura->save();
        return $prefeitura;
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

        $cnpjValidation = Prefeitura::where('cnpj', $data['cnpj'])->get()->first();

        if ($cnpjValidation && $cnpjValidation->id != $prefId) {
            throw new Exception('Erro! CNPJ em uso!');
            return false;
        }
        $emailValidation = Prefeitura::where('email', $data['email'])->get()->first();

        if ($emailValidation && $emailValidation->id != $prefId) {
            throw new Exception('Erro! Email em uso!');
            return false;
        }

        return true;
    }
}