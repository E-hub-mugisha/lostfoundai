<?php

namespace App\Mail;

use App\Models\FoundDocument;
use App\Models\LostDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MatchConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $foundDoc;
    public $lostDoc;

    public function __construct(FoundDocument $foundDoc, LostDocument $lostDoc)
    {
        $this->foundDoc = $foundDoc;
        $this->lostDoc = $lostDoc;
    }

    public function build()
    {
        return $this->subject('Document Match Confirmed')
                    ->view('emails.match_confirmed');
    }
}
