<?php 

namespace App\UseCases\Prefeitura;

use App\Models\Prefeitura;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Storage;

class RemoveLogoUseCase
{

    public function execute(Prefeitura $prefeitura): Prefeitura
    {
        if (isset($prefeitura->logo) && Storage::exists($prefeitura->logo)) {
            Storage::delete($prefeitura->logo);
        }
        
        $prefeitura->logo = null;

        $prefeitura->save();
        
        return $prefeitura;
    }

}