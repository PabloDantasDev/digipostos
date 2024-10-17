<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CadastroPostosController extends Controller
{
    public function index() 
    {
        return view('content.components.postos.cadastro-postos');
    }

    public function funcionarios(Request $request)
    {
        $postoId = $request->postoId ? $request->postoId : null;
        return view('content.components.postos.cadastro-funcionarios')->with(compact('postoId'));
    }
}
