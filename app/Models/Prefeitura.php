<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prefeitura extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'cnpj',
        'adress',
        'city',
        'uf',
        'contact',
        'mayor',
        'phone',
        'email',
        'logo',
        'password'
    ];

    public function secretaria()
    {
        return $this->hasMany(Secretaria::class, 'prefeitura_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'department_id', 'id');
    }
    
    use HasFactory;
}
