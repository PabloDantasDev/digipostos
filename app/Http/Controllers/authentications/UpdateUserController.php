<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\UseCases\User\UpdateUserUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUserController extends Controller
{
    //
    public function update(Request $request)
    {
        $userCase = new UpdateUserUseCase;

        $data = [
            'name' => $request->name,
            'password' => $request->password
        ];

        $userCase->execute(Auth::user()->id, $data);

        return redirect()->route('home-page');
    }

    public function updateView()
    {
        return view('content.components.user.update-user');
    }
}
