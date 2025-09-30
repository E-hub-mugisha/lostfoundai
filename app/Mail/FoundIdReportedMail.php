<?php

namespace App\Mail;

use App\Models\ExtractedDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FoundIdReportedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $document;

    public function __construct(ExtractedDocument $document)
    {
        $this->document = $document;
    }

    public function build()
    {
        return $this->subject('Found ID Reported')
                    ->view('emails.found_id_reported');
    }
}
