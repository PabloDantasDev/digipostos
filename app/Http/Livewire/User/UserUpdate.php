<?php

namespace App\Http\Livewire\User;

use App\Models\Prefeitura;
use App\UseCases\User\UpdateUserUseCase;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserUpdate extends Component
{
    public $userName;
    public $userEmail;
    public $userPassword;
    public $prefeituraName;

    public function mount()
    {
        $this->prefeituraName = Prefeitura::select('name')
            ->first()
            ->pluck('name')[0];
        $user = Auth::user();
        $this->userName = $user->name;
        $this->userEmail = $user->email;
    }

    public function render()
    {
        return view('livewire.user.user-update');
    }

    public function updateUser()
    {
        dd("teste");
        try {
            $userCase = new UpdateUserUseCase;

            $data = [
                'name' => $this->userName,
                'email' => $this->userEmail,
                'password' => $this->userPassword,
                'confirm_password' => $this->userConfirmPassword
            ];

            $userCase->execute(Auth::user()->id, $data);
            $this->emitTo('flash-message', 'flashMessage', 'Posto atualizado com sucesso!');

            return url('/');
        } catch (Exception $e) {
            $this->emitTo('flash-message', 'flashMessage', $e->getMessage(), 'danger');
        }
    }
}
