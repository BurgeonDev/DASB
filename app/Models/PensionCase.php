<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PensionCase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pensioner_id',
        'pen_ex_no',
        'status',
        'pen_do_entry',
        'reg_ser_no',
        'gp_insurance_claim_ltr',
        'benfund_claim_ltr',
        'dasb_ltr_no',
        'dasb_ltr_date',
        'finalized_date',
        'remarks',
    ];

    // 🔑 Relation to Pensioner
    public function pensioner()
    {
        return $this->belongsTo(Pensioner::class);
    }

    // (optional) if you really plan to use Status model:
    public function statusRelation()
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
