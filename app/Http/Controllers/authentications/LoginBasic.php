<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Prefeitura;
use Illuminate\Http\Request;

class LoginBasic extends Controller
{
  public function index()
  {
    $prefeitura = Prefeitura::select('name', 'logo')
      ->first();

    if($prefeitura)
    {
      $logo = url("storage/{$prefeitura->logo}");
      $name = $prefeitura->name;
    } else {
      $logo = url("storage/logos/touros.png");
      $name = 'PREFEITURA MUNICIPAL DE TOUROS';
    }

    return view('content.authentications.auth-login-basic', [
      'logo' => $logo,
      'name' => $name
    ]);
  }
}
