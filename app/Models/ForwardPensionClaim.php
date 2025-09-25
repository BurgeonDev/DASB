<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForwardPensionClaim extends Model
{
    protected $fillable = [
        'from_location',
        'to_location',
        'pension_no',
        'claimant',
        'relation',
        'date',
        'documents',
        'message', // ✅ new
    ];

    protected $casts = [
        'documents' => 'array',
        'to_location' => 'array', // ✅ store multiple
        'date' => 'date',
    ];
}
