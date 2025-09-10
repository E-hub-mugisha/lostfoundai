<?php

namespace App\Services;

use TesseractOCR;
use thiagoalessio\TesseractOCR\TesseractOCR as TesseractOCRTesseractOCR;

class OCRService
{
    /**
     * Extract text from an image using Tesseract OCR.
     *
     * @param string $imagePath
     * @return string
     */
    public function extractText(string $relativePath): string
{
    $absolutePath = storage_path("app/{$relativePath}");

    return (new TesseractOCRTesseractOCR($absolutePath))->run();
}

}
