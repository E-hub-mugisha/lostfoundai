<?php

namespace App\Mail;

use App\Models\ExtractedDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminMatchedIdMail extends Mailable
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
        return $this->subject('ID Matched Notification')
                    ->view('emails.admin_matched_id');
    }
}
