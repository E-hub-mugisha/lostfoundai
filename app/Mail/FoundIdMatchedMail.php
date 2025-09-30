<?php

namespace App\Mail;

use App\Models\ExtractedDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FoundIdMatchedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lostDoc;
    public $foundDoc;

    public function __construct(ExtractedDocument $lostDoc, ExtractedDocument $foundDoc)
    {
        $this->lostDoc = $lostDoc;
        $this->foundDoc = $foundDoc;
    }

    public function build()
    {
        return $this->subject('You Found a Reported Lost ID')
                    ->view('emails.found_id_matched');
    }
}
