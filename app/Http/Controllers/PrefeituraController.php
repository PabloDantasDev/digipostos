<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrefeituraController extends Controller
{
    public function index()
    {
        // Aqui você pode listar todas as prefeituras ou fazer outra operação.
        $prefeituras = Prefeitura::all(); // Exemplo de listar todas as prefeituras
        return view('prefeitura.index', compact('prefeituras'));
    }
}