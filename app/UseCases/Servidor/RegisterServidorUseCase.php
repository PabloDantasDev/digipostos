<?php 

namespace App\UseCases\Servidor;

use App\Models\Servidor;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class RegisterServidorUseCase
{
    public function execute(array $data): void
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2,
            'department_id' => $data['department_id'],
        ]);
    }
}