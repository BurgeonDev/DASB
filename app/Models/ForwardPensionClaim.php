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
    ];

    protected $casts = [
        'documents' => 'array', // ✅ makes 
        'date' => 'date',
    ];
}
