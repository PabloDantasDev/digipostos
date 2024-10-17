<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{

    protected $fillable = [
        'name',
        'prefeitura_id',
    ];
    
    use HasFactory;

    public function prefeitura() 
    {
        return $this->hasOne(Prefeitura::class , 'id', 'prefeitura_id');
    }

    public function veiculo()
    {
        return $this->hasMany(Veiculo::class, 'secretaria_id', 'id');
    }

    public function servidor()
    {
        return $this->hasMany(Servidor::class, 'secretaria_id', 'id');
    }

}
