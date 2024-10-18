<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = [
        'name',
        'license_plate',
        'model',
        'year',
        'productor',
        'color',
        'fuel',
        'tank_capacity',
        'initial_km',
        'final_km',
        'prefeitura_id',
        'secretaria_id',
        'combustivel_id'
    ];

    use HasFactory;

    public function secretaria()
    {
        return $this->hasOne(Secretaria::class, 'id', 'secretaria_id');
    }

    public function servidor()
    {
        return $this->hasOne(Servidor::class, 'veiculo_id', 'id');
    }
    public function credito()
    {
        return $this->belongsTo(Credito::class, 'veiculo_id', 'id');
    }
    public function baixa() 
    {
        return $this->hasMany(Baixa::class, 'veiculo_id', 'id');
    }

    public function combustivel()
    {
        return $this->belongsTo(Combustivel::class, 'combustivel_id', 'id');
    }

    public function countVeiculos(){

        return self::count();

    }
}
