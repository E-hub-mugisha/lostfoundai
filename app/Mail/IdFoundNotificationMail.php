<?php

namespace App\Mail;

use App\Models\ExtractedDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IdFoundNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $foundDoc;
    public $lostDoc;

    public function __construct(ExtractedDocument $foundDoc, ExtractedDocument $lostDoc)
    {
        $this->foundDoc = $foundDoc;
        $this->lostDoc = $lostDoc;
    }

    public function build()
    {
        return $this->subject('Your Lost ID Was Found')
                    ->view('emails.id_found_notification');
    }
}
