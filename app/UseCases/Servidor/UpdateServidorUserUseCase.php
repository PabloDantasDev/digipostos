<?php 

namespace App\UseCases\Servidor;

use App\Models\Servidor;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class UpdateServidorUserUseCase
{
    public function execute(int $servId, array $data): void
    {
        $user = User::where('department_id', $servId)->where('role_id', 2)->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role_id = 2;

        $user->save();
    }
}