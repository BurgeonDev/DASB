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

    // ✅ Cascade soft delete children
    protected static function booted()
    {
        static::deleting(function ($pensioner) {
            if ($pensioner->isForceDeleting()) {
                $pensioner->familyMembers()->forceDelete();
                $pensioner->pensionCases()->forceDelete();
                $pensioner->benFunds()->forceDelete();
            } else {
                $pensioner->familyMembers()->delete();
                $pensioner->pensionCases()->delete();
                $pensioner->benFunds()->delete();
            }
        });

        static::restoring(function ($pensioner) {
            $pensioner->familyMembers()->withTrashed()->restore();
            $pensioner->pensionCases()->withTrashed()->restore();
            $pensioner->benFunds()->withTrashed()->restore();
        });
    }

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
