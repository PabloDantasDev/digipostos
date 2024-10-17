<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostoController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $credId = $request->credId;
        return view('content.components.funcionario.funcionario')->with(compact('user', 'credId'));
    }
}
