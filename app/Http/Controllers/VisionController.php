<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VisionController extends Controller
{
    public function index()
    {
        return view('vision.upload');
    }

    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $imagePath = $request->file('image')->getRealPath();
        $imageData = base64_encode(file_get_contents($imagePath));

        $apiKey = env('GOOGLE_VISION_API_KEY');

        $response = Http::post("https://vision.googleapis.com/v1/images:annotate?key=$apiKey", [
            'requests' => [
                [
                    'image' => [
                        'content' => $imageData,
                    ],
                    'features' => [
                        [
                            'type' => 'TEXT_DETECTION',
                        ]
                    ],
                ],
            ]
        ]);

        // Debug output
        if (!$response->successful()) {
            Log::error('Google Vision API Error:', $response->json());
            return back()->with('error', 'API request failed. Check logs or API key.');
        }

        $result = $response->json();
        $text = $result['responses'][0]['fullTextAnnotation']['text'] ?? 'No text found.';

        return view('vision.upload', ['parsedText' => $text]);
    }
}
