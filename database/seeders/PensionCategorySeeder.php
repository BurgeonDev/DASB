<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PensionCategory;

class PensionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['pen_cat' => 'Compensatory Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Dependent Family Pension', 'pen_cat_code' => '3', 'pen_type' => 'Family Pensioner'],
            ['pen_cat' => 'Disability Pension', 'pen_cat_code' => '2', 'pen_type' => 'Retired'],
            ['pen_cat' => 'EPCAF', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Ex Gratia Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'HKSRA Pensioner', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Invalid Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Med Board Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Non Pensioner', 'pen_cat_code' => '5', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Ord Family Pension', 'pen_cat_code' => '3', 'pen_type' => 'Family Pensioner'],
            ['pen_cat' => 'Perm Disability Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Retiring Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Short Voluntary Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Spec Family Pension (In Svc Death)', 'pen_cat_code' => '3', 'pen_type' => 'Family Pensioner'],
            ['pen_cat' => 'Spec Family Pension (Shaheed)', 'pen_cat_code' => '4', 'pen_type' => 'Family Pensioner'],
            ['pen_cat' => 'Special Reserve Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Supernuation Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Temp Disability Pension', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
            ['pen_cat' => 'Two Pensions', 'pen_cat_code' => '1', 'pen_type' => 'Retired'],
        ];

        PensionCategory::insert($categories);
    }
}
