<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role_id == 2) {
            return view('content.components.servidor.servidor')->with(compact('user'));
        }
        if ($user->role_id == 1) {
            return view('content.components.dashboard');
        }
        if ($user->role_id == 4) {
            return view('content.dashboard.dashboards-analytics');
        }
    }

}
