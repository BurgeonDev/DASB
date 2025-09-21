<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['status_code' => 'CMA (P)', 'progress_code' => '4', 'reminder_interval' => 2, 'reminder_status' => 'Yes', 'update_status' => null],
            ['status_code' => 'Finalized', 'progress_code' => '5', 'reminder_interval' => 0, 'reminder_status' => 'No', 'update_status' => null],
            ['status_code' => 'Initiated', 'progress_code' => '1', 'reminder_interval' => 2, 'reminder_status' => 'Yes', 'update_status' => null],
            ['status_code' => 'Observed', 'progress_code' => '2', 'reminder_interval' => 0, 'reminder_status' => 'No', 'update_status' => null],
            ['status_code' => 'PSO', 'progress_code' => '3', 'reminder_interval' => 2, 'reminder_status' => 'Yes', 'update_status' => null],
            ['status_code' => 'Rejected', 'progress_code' => '6', 'reminder_interval' => 0, 'reminder_status' => 'No', 'update_status' => null],
        ];

        Status::insert($statuses);
    }
}
