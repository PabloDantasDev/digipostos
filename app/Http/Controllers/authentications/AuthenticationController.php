<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthenticationController extends Controller
{
    
    public function login(Request $request)
    {
        try {

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                return redirect()->intended('/');
            }

            return back()->withErrors([
                'email' => 'invalid credentials',
                'password' => 'invalid credentials'
            ])->onlyInput('email');
            
        }catch(Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Credenciais inválidas. Verifique seu e-mail e senha.']);
        }



    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('home-page');
    }

    public function register(Request $request)
    {
        
        try {
            $credentials = $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users')],
                'password' => ['required', 'confirmed', 'min:8'],
                'terms' => ['required'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 1
            ]);

            return redirect()->route('auth-login-basic');

        }catch(Exception $e) {
            return redirect()->back();
        }
    }

    public function registerFuncionario(Request $request) 
    {
        try {
            $credentials = $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users')],
                'password' => ['required', 'min:6'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 1
            ]);

            return redirect()->route('auth-login-basic');

        }catch(Exception $e) {
            return redirect()->back();
        }
    }
}
