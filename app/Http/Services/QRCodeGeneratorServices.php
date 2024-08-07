<?php

namespace App\Services;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QRCodeGeneratorServices {

    private $tlvString;

    public function __construct($tlvString) {
        $this->tlvString = $tlvString;
    }

    private function generateTLV() {
        $result = '';
        $data = $this->tlvString;
        while ($data !== '') {
            $tag = substr($data, 0, 2);
            $length = substr($data, 2, 2);
            $value = substr($data, 4, (int)$length);
            $result .= $tag . $length . $value;
            $data = substr($data, 4 + (int)$length);
        }
        return $result;
    }

    public function generateQRCode() {
        // Genera el string TLV
        $tlv = $this->generateTLV();

        // Crea el código QR
        $qrCode = new QrCode($tlv);
        $writer = new PngWriter();

        // Guardar el QR en un archivo
        $result = $writer->write($qrCode);
        $filePath = 'qrcode.png';
        $result->saveToFile($filePath);

        return $filePath;
    }
}
