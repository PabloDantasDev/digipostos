<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combustivel extends Model
{
    protected $table = 'combustivels';
    protected $fillable = [
        'name'
    ];

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'combustivel_id', 'id');
    }

    public function baixas()
    {
        return $this->hasManyThrough(
            Baixa::class,
            Veiculo::class            
        );
    }
}
