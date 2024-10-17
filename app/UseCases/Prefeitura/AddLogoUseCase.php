<?php 

namespace App\UseCases\Prefeitura;

use App\Models\Prefeitura;
use Illuminate\Support\Facades\Validator;
use Exception;

class AddLogoUseCase
{

    public function execute(Prefeitura $prefeitura, $imageFile): Prefeitura
    {
        $path = $imageFile->store('logos', 'public');

        if ($path == $prefeitura->logo) {
            return $prefeitura;
        }
        
        $prefeitura->logo = $path;

        $prefeitura->save();
        
        return $prefeitura;
    }

}