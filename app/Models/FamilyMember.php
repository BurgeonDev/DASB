<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pensioner_id',
        'name',
        'relation',
        'dob',
        'do_death',
        'do_marriage',
        'education',
        'profession',
        'marital_status',
        'disability',
        'cnic_no',
        'id_marks',
        'mobile_no',
        'source_of_income',
        'monthly_income',
        'remarks',
        'psb_no',
        'ppo_no',
        'gpo',
        'pdo',
        'net_pension',
        'bank_name',
        'bank_branch',
        'bank_code',
        'bank_acct_no',
        'iban_no',
    ];

    public function pensioner()
    {
        return $this->belongsTo(Pensioner::class);
    }
}
