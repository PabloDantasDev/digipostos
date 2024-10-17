<?php 

namespace App\UseCases\Veiculo;

use App\Models\Combustivel;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Validator;
use Exception;

class UpdateVeiculoUseCase
{

    private array $rules = [ 
        'name' => 'required|max:30',
        'license_plate' => 'required',
        'color' => 'required',
        'fuel' => 'nullable',
        'tank_capacity' => 'required|numeric',
        'initial_km' => 'required|numeric',
        'final_km' => 'required|numeric',
        'secretaria_id' => 'required|exists:secretarias,id',
        'combustivel_id' => 'required|exists:combustivels,id',
    ];

    private array $messages = [
        'name' => 'Nome do veículo inválido!',
        'license_plate' => 'Placa inválida!',
        'color' => 'Cor do veículo, inválida!',
        'fuel' => 'Tipo do combustível inválido!',
        'tank_capacity' => 'Capacidade do tanque inválida!',
        'initial_km' => 'Quilometragemm inicial inválida!',
        'final_km' => 'Quilometragem final inválida!',
        'secretaria_id' => 'Secretaria inválida!',
        'combustivel_id' => 'Combustível inválido!',
    ];

    public function execute(int $veicId, array $data): Veiculo
    {
        $this->validate($data, $veicId);
        
        $veiculo = Veiculo::find($veicId);

        if (!$veiculo) {
            throw new Exception('Erro! Veiculo não encontrado.');
        }

        if(!array_key_exists('fuel', $data))
        {
            $combustivel  = Combustivel::find($data['combustivel_id']);
            $veiculo->fuel = $combustivel->name;
        } else {
            $veiculo->fuel = $data['fuel'];
        }

        $veiculo->name = $data['name'];
        $veiculo->license_plate = $data['license_plate'];
        $veiculo->color = $data['color'];        
        $veiculo->tank_capacity = $data['tank_capacity'];
        $veiculo->initial_km = $data['initial_km'];
        $veiculo->final_km = $data['final_km'];
        $veiculo->secretaria_id = $data['secretaria_id'];
        $veiculo->combustivel_id = $data['combustivel_id'];

        $veiculo->save();
        
        return $veiculo;
    }

    private function validate(array $data, $veicId) : bool
    {
        $validator = Validator::make($data, $this->rules , $this->messages);
        if( $validator->fails() )
        {
            $firstError = $validator->errors()->first();
            throw new Exception('Erro! ' . $firstError);
            return false;
        }
        
        $plateValidation = Veiculo::where('license_plate', $data['license_plate'])->get()->first();

        if ($plateValidation && $plateValidation->id != $veicId) {
            throw new Exception('Erro! Placa em uso!');
            return false;
        }

        return true;
    }
}