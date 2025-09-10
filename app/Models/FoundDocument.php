<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoundDocument extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'id_number',
        'id_type',
        'date_found',
        'location_found',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
