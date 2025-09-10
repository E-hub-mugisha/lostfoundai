<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtractedDocument extends Model
{
    protected $fillable = [
        'names', 'dob', 'sex', 'place_of_issue', 'id_number', 'file_path', 'status'
    ];
}
