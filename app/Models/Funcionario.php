<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'sex',
        'posto_id',
        'phone',
        'cellphone',
        'email',
        'password',
        'terms',
    ];

    use HasFactory;

    public function posto()
    {
        return $this->hasOne(Posto::class, 'id', 'posto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'department_id', 'id');
    }
    public function baixa() 
    {
        return $this->hasMany(Baixa::class, 'funcionario_id', 'id');
    }
}
