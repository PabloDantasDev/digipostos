<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'fuel',
        'value_per_liter',
        'veiculo_id',
        'posto_id',
        'validity',
        'fuel_credit',
        'combustivel_id'
    ];

    public function veiculo() 
    {
        return $this->hasOne(Veiculo::class, 'id', 'veiculo_id');
    }

    public function posto()
    {
        return $this->hasOne(Posto::class, 'id', 'posto_id');
    }

    public function CreditUpdateLogs()
    {
        return $this->hasMany(CreditUpdate::class, 'credito_id', 'id');
    }

    public function combustivel()
    {
        return $this->belongsTo(Combustivel::class, 'combustivel_id', 'id');
    }
}
