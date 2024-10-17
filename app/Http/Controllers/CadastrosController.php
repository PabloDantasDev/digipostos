<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CadastrosController extends Controller
{
    public function index() 
    {
        return view('content.components.cadastros.prefeituras');
    }

    public function secretarias(Request $request) 
    {
        $prefeituraId = $request->prefeituraId ? $request->prefeituraId : null;
        
        return view('content.components.cadastros.secretarias')->with(compact('prefeituraId'));
    }

    public function veiculos(Request $request) 
    {
        $secretariaId = $request->secretariaId ? $request->secretariaId : null;
        // $search = true;
        
        // return view('content.components.cadastros.veiculos')->with(compact('secretariaId', 'search'));
        return view('content.components.cadastros.veiculos')->with(compact('secretariaId'));
    }
    
    public function servidores(Request $request) 
    {
        $secretariaId = $request->secretariaId ? $request->secretariaId : null;

        return view('content.components.cadastros.servidores')->with(compact('secretariaId'));
    }
}
