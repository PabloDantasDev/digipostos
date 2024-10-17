<?php 

namespace App\UseCases\Funcionario;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class RegisterFuncionarioUseCase
{
    public function execute(array $data): void
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 3,
            'department_id' => $data['department_id'],
        ]);
    }
}