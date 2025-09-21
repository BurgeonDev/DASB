<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PensionCategory extends Model
{
    protected $table = 'pension_categories';

    protected $fillable = [
        'pen_cat',
        'pen_cat_code',
        'pen_type',
    ];
}
