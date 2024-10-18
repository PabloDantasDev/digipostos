<?php

namespace App\Http\Controllers;

use App\Models\Prefeitura; // Importar o modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Redirecionar para diferentes views com base no role_id
        if ($user->role_id == 2) {
            return view('content.components.servidor.servidor')->with(compact('user'));
        }
        if ($user->role_id == 1) {
            return view('content.components.dashboard');
        }
        if ($user->role_id == 4) {
            return view('content.dashboard.dashboards-analytics');
        }

        // Contar prefeituras cadastradas
        $prefeiturasCount = Prefeitura::count(); // Defina a variável aqui

        // Passar a contagem para a view
        return view('dashboard', compact('prefeiturasCount')); // Passar a variável para a view
    }
}
