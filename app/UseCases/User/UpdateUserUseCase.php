<?php 

namespace App\UseCases\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UpdateUserUseCase
{
    public function execute(int $user_id, array $data) : User
    {
        $user = User::where('id', $user_id)
            ->first();

        $user->update([
            'name' => $data['name'],
            'password' => Hash::make($data['password'])
        ]);

        return $user;
    }
}