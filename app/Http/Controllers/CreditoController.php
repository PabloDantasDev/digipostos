<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Credito;
use App\UseCases\Qrcode\CreateQrcodeUseCase;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function index() 
    {
        // $search = true;
        
        // return view('content.components.creditos.creditos')->with(compact('search'));
        return view('content.components.creditos.creditos');
    }

    public function generateQrCode(Request $request) 
    {
        $useCase = new CreateQrcodeUseCase();
        $qrcode = url($useCase->execute($request->credId));

        $credito = Credito::find($request->credId);
        $placa = $credito->veiculo->license_plate;
        
        return view('content.components.creditos.qrcode')->with(compact('qrcode', 'placa'));
    }
}
