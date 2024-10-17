<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CombustivelController extends Controller
{
    //
    public function index()
    {
        return view('content.components.postos.cadastro-combustivel');
    }
}
