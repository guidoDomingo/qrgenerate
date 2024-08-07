<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Services\QRCodeGeneratorServices;
use Illuminate\Http\Request;

class QrGenerateController {

    private $services;
    private $tlvString;

    public function __construct(Request $request ) {
        $this->tlvString = $request->input('tlvString');
        $this->services = new QRCodeGeneratorServices($this->tlvString);
    }

 
    public function generateQRCode() {
       return $this->services->generateQRCode();
    }
}

