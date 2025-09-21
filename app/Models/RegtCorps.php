<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegtCorps extends Model
{
    protected $fillable = [
        'force_code',
        'force',
        'regt_code',
        'rw',
        'rw_loc',
        'rw_tel_no',
        'urdu_rw',
        'urdu_rw_loc',
        'urdu_regt',
        'text_sro',
        'urdu_text_sro',
    ];
    public function getDisplayNameAttribute()
    {
        return $this->rw
            ? "{$this->rw} ({$this->force})"
            : $this->force;
    }
}
