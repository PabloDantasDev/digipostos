<?php 

namespace App\UseCases\Qrcode;

use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Validator;
use Exception;

class CreateQrcodeUseCase
{
    private string $url;
    public $fileName = 'qrcode.svg';

    public function execute($id)
    {
        $this->url = url('/frentista'). '/' . $id;
        
        $renderer = new ImageRenderer(
            new RendererStyle(400), // Tamanho do QR Code
            new SvgImageBackEnd() // Formato do arquivo de imagem
        );

        $writer = new Writer($renderer);

        $writer->writeFile($this->url, $this->fileName);

        return $this->fileName;
    }

}