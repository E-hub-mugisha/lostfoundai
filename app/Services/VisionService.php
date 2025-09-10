<?php

namespace App\Services;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;

class VisionService
{
    protected $client;

    public function __construct()
    {
        $this->client = new ImageAnnotatorClient([
            'credentials' => base_path('storage/app/google-vision.json'),
        ]);
    }

    /**
     * Extract text from image (OCR)
     */
    public function detectText($imagePath)
    {
        $image = file_get_contents($imagePath);

        // use documentTextDetection for better OCR
        $response = $this->client->documentTextDetection($image);
        $annotation = $response->getFullTextAnnotation();

        $this->client->close();

        return $annotation ? $annotation->getText() : '';
    }

    /**
     * Detect faces in the image
     */
    public function detectFaces($imagePath)
    {
        $image = file_get_contents($imagePath);

        $response = $this->client->faceDetection($image);
        $faces = $response->getFaceAnnotations();

        $this->client->close();

        return $faces ?? [];
    }
}
