<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BenFund extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pensioner_id',
        'bank_name',
        'branch_code',
        'bank_acct_no',
        'iban_no',
        'amount_received',
        'amount_received_date',
        'remarks',
        'marital_status',
        'dasb_file_no',
        'originator',
        'originator_ltr_date',
        'originator_ltr_no',
        'originator_contents',
        'status',
        'hwo_concerned',
    ];

    // Relation back to Pensioner
    public function pensioner()
    {
        return $this->belongsTo(Pensioner::class);
    }
}
