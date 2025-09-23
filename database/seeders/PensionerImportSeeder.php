<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pensioner;
use App\Models\RegtCorps;
use Carbon\Carbon;

class PensionerImportSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/pensioners.csv');

        if (!file_exists($file)) {
            $this->command->error("CSV file not found: $file");
            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle); // read first row as headers

        $count = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            // 🔹 map Regt/Corps to regt_corps_id
            $regtCorps = null;
            if (!empty($data['Regt/Corps'])) {
                $regtCorps = RegtCorps::firstOrCreate(
                    ['force' => $data['Regt/Corps']],
                    ['force_code' => $data['Regt/Corps']]
                );
            }

            // 🔹 insert pensioner
            Pensioner::updateOrCreate(
                [
                    'personal_no' => (string) intval($data['Personal No']), // ✅ strip decimals
                ],
                [
                    'prefix'        => $data['PreFix'] ?? null,
                    'personal_no'   => (string) intval($data['Personal No']), // ✅ strip decimals
                    'trade'         => $data['Trade'] ?? null,
                    'name'          => $data['Names'] ?? null,
                    'regt_corps_id' => $regtCorps?->id,
                    'type_of_pension' => $data['Type of Pension'] ?? null,
                    'parent_unit'   => $data['Parent Unit'] ?? null,
                    'nok_name'      => $data['NOK Name'] ?? null,
                    'nok_relation'  => $data['NOK Relation'] ?? null,
                    'village'       => $data['Village'] ?? null,
                    'post_office'   => $data['Post Office'] ?? null,
                    'uc_name'       => $data['UC Name'] ?? null,
                    'tehsil'        => $data['Tehsil'] ?? null,
                    'district'      => $data['District'] ?? null,
                    'present_address' => $data['Present Address'] ?? null,
                    'mobile_no'     => $data['Mobile No'] ?? null,
                    'cnic_no'       => $data['CNIC No'] ?? null,
                    'net_pension'   => is_numeric($data['Net Pension'])
                        ? (float) $data['Net Pension']
                        : null,
                    'date_of_entry' => !empty($data['DO Enlt'])
                        ? Carbon::parse($data['DO Enlt'])
                        : null,
                ]
            );



            $count++;
        }

        fclose($handle);

        $this->command->info("✅ Imported $count pensioners from CSV.");
    }
}
