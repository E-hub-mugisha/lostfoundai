<?php

namespace App\Http\Controllers;

use App\Mail\AdminMatchedIdMail;
use App\Mail\FoundIdMatchedMail;
use App\Mail\FoundIdReportedMail;
use App\Mail\IdFoundNotificationMail;
use App\Mail\LostIdConfirmationMail;
use App\Mail\LostIdReportedMail;
use App\Models\ExtractedDocument;
use App\Models\LostDocument;
use App\Services\OCRService;
use App\Services\VisionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Support\Facades\Mail;
use OpenAI\Laravel\Facades\OpenAI;

class LostDocumentController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $lostDocs = LostDocument::where('user_id', Auth::id())->latest()->get();
        return view('documents.losts.index', compact('lostDocs'));
    }

    public function create()
    {
        return view('lost_ids.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'nullable|string|max:100',
            'id_type' => 'required|in:NID,Passport,License',
            'date_lost' => 'nullable|date',
            'location_lost' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('lost_ids', 'public');
        }

        $data['user_id'] = Auth::id();
        LostDocument::create($data);

        return redirect()->route('lost-documents.index')->with('success', 'Lost ID reported successfully.');
    }

    public function show(LostDocument $lostDoc)
    {
        return view('documents.losts.show', compact('lostDoc'));
    }

    public function edit(LostDocument $lostDoc)
    {
        return view('lost_ids.edit', compact('lostDoc'));
    }

    public function update(Request $request, LostDocument $lostDoc)
    {
        $this->authorize('update', $lostDoc);

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'nullable|string|max:100',
            'id_type' => 'required|in:NID,Passport,License',
            'date_lost' => 'nullable|date',
            'location_lost' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($lostDoc->image);
            $data['image'] = $request->file('image')->store('lost_ids', 'public');
        }

        $lostDoc->update($data);
        return redirect()->route('lost-documents.index')->with('success', 'Lost ID updated.');
    }

    public function destroy($id)
    {
        $lostDoc = ExtractedDocument::findOrFail($id);
        $lostDoc->delete();

        return back()->with('success', 'Lost ID deleted.');
    }


    public function processAI(Request $request)
    {
        $request->validate([
            'document' => 'required|image|max:4096',
            'type' => 'required|in:lost,found', // specify if it's lost or found
        ]);

        $type = $request->input('type'); // lost or found

        // Save file
        $path = $request->file('document')->store('documents', 'public');
        $filePath = storage_path('app/public/' . $path);

        // Encode image to Base64
        $base64Image = base64_encode(file_get_contents($filePath));

        // Send to OpenAI for extraction
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are an OCR and data extraction assistant for Rwandan IDs. Output clean JSON only.'],
                [
                    'role' => 'user',
                    'content' => [
                        ['type' => 'text', 'text' => 'Extract all details from this ID and return JSON with {names, dob, sex, place_of_issue, id_number}'],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => 'data:image/jpeg;base64,' . $base64Image,
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $json = $result['choices'][0]['message']['content'];
        preg_match('/\{.*\}/s', $json, $matches);
        $data = json_decode($matches[0] ?? '{}', true);

        // Format DOB
        $dob = null;
        if (!empty($data['dob'])) {
            try {
                $dob = Carbon::createFromFormat('d/m/Y', $data['dob'])->format('Y-m-d');
            } catch (\Exception $e) {
                $dob = null;
            }
        }

        // Check if ID already exists
        $existingDoc = ExtractedDocument::where('id_number', $data['id_number'] ?? '')->first();

        if ($existingDoc) {
            if ($type === 'found' && $existingDoc->status === 'lost') {
                // ID was reported lost → FOUND match
                $document = ExtractedDocument::create([
                    'user_id' => auth()->id(),
                    'names' => $data['names'] ?? '',
                    'dob' => $dob,
                    'sex' => $data['sex'] ?? '',
                    'place_of_issue' => $data['place_of_issue'] ?? '',
                    'id_number' => $data['id_number'] ?? '',
                    'file_path' => $path,
                    'status' => 'matched',
                ]);

                // Notify both parties
                Mail::to($existingDoc->user->email)->send(new IdFoundNotificationMail($document, $existingDoc)); // User who lost
                Mail::to($document->user->email)->send(new FoundIdMatchedMail($existingDoc, $document)); // User who found
                Mail::to('kabosierik@gmail.com')->send(new AdminMatchedIdMail($existingDoc, $document));

                return view('documents.matched', [
                    'file' => asset('storage/' . $path),
                    'extracted' => $json,
                    'document' => $document,
                    'existing' => $existingDoc,
                ]);
            }

            // ID already exists (lost or found) → just show existing
            return view('documents.exists', [
                'file' => asset('storage/' . $path),
                'extracted' => $json,
                'document' => $existingDoc
            ]);
        }

        // Store new document
        $document = ExtractedDocument::create([
            'user_id' => auth()->id(),
            'names' => $data['names'] ?? '',
            'dob' => $dob,
            'sex' => $data['sex'] ?? '',
            'place_of_issue' => $data['place_of_issue'] ?? '',
            'id_number' => $data['id_number'] ?? '',
            'file_path' => $path,
            'status' => $type === 'lost' ? 'lost' : 'found',
        ]);

        // Notify users/admin
        if ($type === 'lost') {
            Mail::to('kabosierik@gmail.com')->send(new LostIdReportedMail($document));
            Mail::to($document->user->email)->send(new LostIdConfirmationMail($document));
        } else {
            Mail::to('kabosierik@gmail.com')->send(new FoundIdReportedMail($document));
        }

        return view('documents.result', [
            'file' => asset('storage/' . $path),
            'extracted' => $json,
            'document' => $document
        ]);
    }



    public function indexAI()
    {
        $lostDocs = ExtractedDocument::all();
        return view('documents.index', compact('lostDocs'));
    }

    public function updateVerify($id)
    {
        $document = ExtractedDocument::findOrFail($id);
        $document->status = 'verified';
        $document->update();

        return back()->with('success', 'Document verified successfully.');
    }

    public function foundAI()
    {
        $lostDocs = ExtractedDocument::where('status', 'found')->get();
        return view('documents.found.index', compact('lostDocs'));
    }
}
