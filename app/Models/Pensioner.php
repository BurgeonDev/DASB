<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pensioner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date_of_entry',
        'prefix',
        'personal_no',
        'trade',
        'name',
        'type_of_pension',
        'parent_unit',
        'nok_name',
        'nok_relation',
        'village',
        'post_office',
        'uc_name',
        'tehsil',
        'district',
        'present_address',
        'mobile_no',
        'cnic_no',
        'net_pension',
        'rank_id',
        'regt_corps_id',
    ];

    // ✅ Relations
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function pensionCases()
    {
        return $this->hasMany(PensionCase::class);
    }

    public function benFunds()
    {
        return $this->hasMany(BenFund::class);
    }


    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function regtCorps()
    {
        return $this->belongsTo(RegtCorps::class);
    }
}
