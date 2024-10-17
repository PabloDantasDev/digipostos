<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baixa extends Model
{
    use HasFactory;

    protected $fillable = [
        'liters',
        'value',
        'date',
        'km',
        'veiculo_id',
        'funcionario_id',
        'password'
    ];
    
    public function veiculo()
    {
        return $this->hasOne(Veiculo::class, 'id', 'veiculo_id');
    }
    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id', 'funcionario_id');
    }

}
