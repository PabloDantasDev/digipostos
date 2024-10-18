<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'sex',
        'secretaria_id',
        'phone',
        'cellphone',
        'email',
        'password',
        'terms',
        'veiculo_id'
    ];
    
    use HasFactory;

    protected $table = 'servidores';

    public function secretaria()
    {
        return $this->hasOne(Secretaria::class, 'id', 'secretaria_id');
    }
    public function veiculo()
    {
        return $this->hasOne(Veiculo::class, 'id', 'veiculo_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'department_id', 'id');
    }

    public function countServidor(){

        return self::count();

    }
}
