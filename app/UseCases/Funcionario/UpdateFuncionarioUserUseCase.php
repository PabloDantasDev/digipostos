<?php 

namespace App\UseCases\Funcionario;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class UpdateFuncionarioUserUseCase
{
    public function execute(int $funcId, array $data): void
    {
        $user = User::where('department_id', $funcId)->where('role_id', 3)->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role_id = 3;

        $user->save();
    }
}