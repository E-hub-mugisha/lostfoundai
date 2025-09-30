<?php

namespace App\Mail;

use App\Models\ExtractedDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LostIdConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $document;

    public function __construct(ExtractedDocument $document)
    {
        $this->document = $document;
    }

    public function build()
    {
        return $this->subject('Your Lost ID Has Been Reported')
                    ->view('emails.lost_id_confirmation');
    }
}
