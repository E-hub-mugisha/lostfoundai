<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchReport extends Model
{
    protected $fillable = [
        'lost_id',
        'found_id',
        'confidence',
        'status',
        'admin_notes',
    ];

    public function lost()
    {
        return $this->belongsTo(LostDocument::class);
    }

    public function found()
    {
        return $this->belongsTo(FoundDocument::class);
    }
}
