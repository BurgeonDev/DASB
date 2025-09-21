<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = [
        'rc',
        'rank_full',
        'rank_cat',
        'rank_cat_code',
        'corres_rank',
        'urdu_rank',
        'af',
    ];
}
