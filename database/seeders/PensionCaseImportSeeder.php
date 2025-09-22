<?php

namespace Database\Seeders;

use App\Models\Pensioner;
use App\Models\PensionCase;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Carbon\Carbon;

class PensionCaseImportSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/pension_cases.csv');

        if (!file_exists($path)) {
            $this->command->error("CSV file not found at: $path");
            return;
        }

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // use first row as header

        foreach ($csv as $record) {
            // Find matching pensioner by PenExNo = personal_no
            $pensioner = Pensioner::where('personal_no', $record['PenExNo'])->first();

            if (!$pensioner) {
                $this->command->warn("No pensioner found for PenExNo: {$record['PenExNo']}");
                continue;
            }

            PensionCase::updateOrCreate(
                [
                    'pen_ex_no' => $record['PenExNo'],
                ],
                [
                    'pensioner_id' => $pensioner->id,
                    'status' => $record['Status'] ?? null,
                    'pen_do_entry' => $this->parseDate($record['PenDOEntry']),
                    'reg_ser_no' => $record['RegSerNo'] ?? null,
                    'gp_insurance_claim_ltr' => $record['GpInsuranceClaimLtrNo and Date'] ?? null,
                    'benfund_claim_ltr' => $record['BenFundClaimLtrNo adn Date'] ?? null,
                    'dasb_ltr_no' => $record['DASBLtrNo'] ?? null,
                    'dasb_ltr_date' => $this->parseDate($record['DASBLtrDate']),
                    'finalized_date' => $this->parseDate($record['FinalizedDate']),
                    'remarks' => $record['Pension Case Remarks'] ?? null,
                ]
            );
        }

        $this->command->info("Pension cases imported successfully.");
    }

    private function parseDate(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
