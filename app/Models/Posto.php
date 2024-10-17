<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'adress',
        'cnpj',
        'inscription',
        'city',
        'uf',
        'phone',
        'email'
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'posto_id', 'id');
    }

    public function credito()
    {
        return $this->hasOne(Credito::class, 'posto_id', 'id');
    }
}
