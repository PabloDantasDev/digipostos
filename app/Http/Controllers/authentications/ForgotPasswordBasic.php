<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Prefeitura;
use Illuminate\Http\Request;

class ForgotPasswordBasic extends Controller
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
      $name = 'DigiPosto';
    }

    return view('content.authentications.auth-forgot-password-basic', [
      'logo' => $logo,
      'name' => $name
    ]);
  }
}
