<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OCRController extends Controller
{
    public function index()
    {
        return view('documents.ocr.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $image = $request->file('image');

        $path = $image->store('private/ocr_uploads');

        $storagePath = storage_path('app/' . $path);

        if (!file_exists($storagePath)) {
            Log::error('File not found right after storage: ' . $storagePath);
            return back()->withErrors(['image' => 'Uploaded file not found on server.']);
        } else {
            Log::info('File exists right after storage: ' . $storagePath);
        }

        $text = (new TesseractOCR($storagePath))
            ->executable(env('TESSERACT_PATH'))
            ->run();

        return view('documents.ocr.result', compact('text'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageFile = $request->file('image');

            // Access file here BEFORE moving it
            $tmpPath = $imageFile->getRealPath();  // file exists here

            $path = 'image/talents/';
            $imageName = time() . '_' . $imageFile->getClientOriginalName();

            // Move the file AFTER reading it
            $imageFile->move(public_path($path), $imageName);

            $image = Image::create([
                'filename' => $imageName,
                'image_data' => $path . $imageName,
            ]);

            return redirect()->route('image.preview', ['id' => $image->id]);
        }

        return redirect()->back()->withErrors(['image' => 'Image upload failed']);
    }


    public function preview($id)
    {
        $image = Image::findOrFail($id);
        return view('documents.ocr.show', compact('image'));
    }

    public function extractText($id)
    {
        $image = Image::findOrFail($id);

        // Get full path to the image
        $publicPath = public_path($image->image_data); // e.g., public/image/talents/filename.png

        // Check if file exists
        if (!file_exists($publicPath)) {
            abort(404, 'Image file not found.');
        }

        // Temporary path for OCR
        $tempPath = storage_path('app/temp/' . $image->filename);
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        // Copy image to temp path
        copy($publicPath, $tempPath);

        // Run Tesseract OCR
        $text = (new TesseractOCR($tempPath))
            ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe')
            ->run();

        // Clean up
        unlink($tempPath);

        return view('documents.ocr.result', compact('text'));
    }
}
