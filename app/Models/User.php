<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function department()
    {
        if ($this->role_id == 2) {
            return $this->hasOne(Servidor::class, 'id', 'department_id');
        }
        if ($this->role_id == 3) {
            return $this->hasOne(Funcionario::class, 'id', 'department_id'); 
        }
        if ($this->role_id == 4) {
            return $this->hasOne(Prefeitura::class, 'id', 'department_id');
        }else {
            return $this->hasOne(Prefeitura::class, 'id', 'department_id');
        }
    }

    public function creditUpdate() 
    {
        return $this->hasMany(CreditUpdate::class, 'user_id', 'id');
    }
}
