<?php

namespace App\Http\Controllers;

use App\Mail\MatchConfirmedMail;
use App\Models\FoundDocument;
use App\Models\LostDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FoundDocumentController extends Controller
{
    public function index()
    {
        $foundDocs = FoundDocument::where('user_id', Auth::id())->latest()->get();
        return view('documents.found.index', compact('foundDocs'));
    }

    public function create()
    {
        return view('found_ids.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image'           => 'required|image|max:2048',
            'full_name'       => 'required|string|max:255',
            'id_number'       => 'required|string|max:255',
            'id_type'         => 'required|in:NID,Passport,License',
            'date_found'      => 'nullable|date',
            'location_found'  => 'nullable|string|max:255',
        ]);

        // Save uploaded image
        $path = $request->file('image')->store('found_docs', 'public');

        // Create record directly from form data
        $found = FoundDocument::create([
            'user_id'        => Auth::id(),
            'full_name'      => $data['full_name'],
            'id_number'      => $data['id_number'],
            'id_type'        => $data['id_type'],
            'date_found'     => $data['date_found'] ?? null,
            'location_found' => $data['location_found'] ?? null,
            'image'          => $path,
            'status'         => 'unverified',
        ]);

        // After storing, check for match
        return $this->verify($found->id_number);
    }

    public function verify($id_number)
    {
        $foundDoc = FoundDocument::where('id_number', $id_number)->first();

        // Look for a lost document that matches name + ID
        $lostDoc = LostDocument::where('id_number', $foundDoc->id_number)
            ->first();

        if ($lostDoc) {
            return view('documents.found.confirmation', [
                'foundDoc' => $foundDoc,
                'lostDoc'  => $lostDoc,
            ]);
        }

        return redirect()->route('found_documents.index')
            ->with('info', 'No matching lost document found.');
    }

    public function confirmMatch($foundId, $lostId)
    {
        $foundDoc = FoundDocument::findOrFail($foundId);
        $lostDoc  = LostDocument::findOrFail($lostId);

        // Update found document
        $foundDoc->status = 'matched';
        $foundDoc->matched_lost_id = $lostDoc->id;
        $foundDoc->save();

        // Update lost document
        $lostDoc->status = 'matched';
        $lostDoc->save();

        // Send email notification
        // You can send to user email or a fixed admin email
        Mail::to($foundDoc->user->email)->send(new MatchConfirmedMail($foundDoc, $lostDoc));

        return redirect()->route('found_documents.index')->with('success', 'Match confirmed and email sent.');
    }


    public function show(FoundDocument $foundDoc)
    {
        return view('documents.found.show', compact('foundDoc'));
    }

    public function destroy($id)
    {
        $foundDoc = FoundDocument::findOrFail($id);

        // Check if the document exists
        if (!$foundDoc) {
            return back()->with('error', 'Found ID not found.');
        }

        // Check if the user is authenticated
        if (!Auth::check()) {
            return back()->with('error', 'You must be logged in to delete a document.');
        }

        // Check if the document belongs to the authenticated user
        if ($foundDoc->user_id !== Auth::id()) {
            return back()->with('error', 'You do not have permission to delete this document.');
        }


        // Delete the document record
        $foundDoc->delete();

        return back()->with('success', 'Found ID deleted successfully.');
    }
}
