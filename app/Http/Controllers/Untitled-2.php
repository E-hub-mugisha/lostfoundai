<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class OCRController extends Controller
{
    // Show image upload form
    public function index()
    {
        return view('documents.ocr.index');
    }

    // Upload and store image in public path
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageFile = $request->file('image');
            $path = 'image/talents/';
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path($path), $imageName);

            $image = Image::create([
                'filename' => $imageName,
                'image_data' => $path . $imageName, // relative path
            ]);

            return redirect()->route('image.preview', $image->id);
        }

        return back()->withErrors(['image' => 'Image upload failed']);
    }

    // Preview uploaded image
    public function preview($id)
    {
        $image = Image::findOrFail($id);
        return view('documents.ocr.show', compact('image'));
    }

    // OCR extraction using Google Vision REST API
    public function extractWithVision($id)
    {
        $image = Image::findOrFail($id);
        $imagePath = public_path($image->image_data);

        if (!file_exists($imagePath)) {
            Log::error('Google Vision API: File not found - ' . $imagePath);
            return back()->withErrors(['image' => 'Image not found for OCR']);
        }

        // Read file and encode base64
        $imageContent = base64_encode(file_get_contents($imagePath));

        $apiKey = env('GOOGLE_VISION_API_KEY');
        if (!$apiKey) {
            Log::error('Google Vision API key not set');
            return back()->withErrors(['api_key' => 'Google Vision API key is missing']);
        }

        $payload = [
            'requests' => [
                [
                    'image' => ['content' => $imageContent],
                    'features' => [
                        ['type' => 'DOCUMENT_TEXT_DETECTION', 'maxResults' => 1],
                    ],
                ],
            ],
        ];

        $response = Http::post("https://vision.googleapis.com/v1/images:annotate?key={$apiKey}", $payload);

        if ($response->failed()) {
            Log::error('Google Vision API error: ' . $response->body());
            return back()->withErrors(['api_error' => 'Google Vision API error: ' . $response->body()]);
        }

        $result = $response->json();

        $text = $result['responses'][0]['fullTextAnnotation']['text'] ?? 'No text detected.';

        return view('documents.ocr.result', compact('text'));
    }
}
