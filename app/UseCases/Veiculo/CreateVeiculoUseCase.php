<?php 

namespace App\UseCases\Veiculo;

use App\Models\Combustivel;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreateVeiculoUseCase
{

    private array $rules = [ 
        'name' => 'required|max:30',
        'license_plate' => 'required|unique:veiculos,license_plate',
        'model' => 'required|max:20',
        'year' => 'required|numeric',
        'productor' => 'required|max:20',
        'color' => 'required',
        'fuel' => 'nullable',
        'tank_capacity' => 'required|numeric',
        'initial_km' => 'required|numeric',
        'final_km' => 'required|numeric',
        'prefeitura_id' => 'required|exists:prefeituras,id',
        'secretaria_id' => 'required|exists:secretarias,id',
        'combustivel_id' => 'required|exists:combustivels,id',
    ];

    private array $messages = [
        'name' => 'Nome do veículo inválido!',
        'license_plate' => 'Placa inválida!',
        'model' => 'Modelo do veículo inválido!',
        'year' => 'Ano do veículo inválido!',
        'productor' => 'Fabricante inválido!',
        'color' => 'Cor do veículo, inválida!',
        'fuel' => 'Tipo do combustível inválido!',
        'tank_capacity' => 'Capacidade do tanque inválida!',
        'initial_km' => 'Quilometragemm inicial inválida!',
        'final_km' => 'Quilometragem final inválida!',
        'secretaria_id' => 'Prefeitura inválida!',
        'combustivel_id' => 'Combustível inválido!',
    ];

    public function execute(array $data): Veiculo
    {
        $this->validate($data);
        
        if(!array_key_exists('fuel', $data))
        {
            $combustivel  = Combustivel::find($data['combustivel_id']);
            $data['fuel'] = $combustivel->name;
        }
        
        $veiculo = Veiculo::create($data);
        
        return $veiculo;
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