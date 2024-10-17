<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'credito_id',
        'user_id',
        'datetime',
        'old_value',
        'new_value',
        'old_fuel',
        'new_fuel',
        'old_validity',
        'new_validity',
    ];

    public function credito()
    {
        return $this->hasOne(Credito::class, 'id', 'credito_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
