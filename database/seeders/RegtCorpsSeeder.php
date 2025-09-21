<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegtCorps;

class RegtCorpsSeeder extends Seeder
{
    public function run(): void
    {
        $regts = [
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '3.0', 'rw' => 'AAD Centre (RW)', 'rw_loc' => 'Malir Cantt - Karachi', 'rw_tel_no' => null, 'urdu_rw' => 'آرمی ائیر ڈیفنس رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'پٹارو (حیدرآباد)', 'urdu_regt' => 'آرمی ائیر ڈیفنس', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '1.0', 'rw' => 'AC Centre (RW)', 'rw_loc' => 'Nowshera Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'آرمڈ کور سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'نوشہرہ کینٹ', 'urdu_regt' => 'آرمڈ کور', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '23.0', 'rw' => 'FF Centre (RW)', 'rw_loc' => 'ACC', 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '16.0', 'rw' => 'AEC Centre (RW)', 'rw_loc' => 'Murree Hills', 'rw_tel_no' => null, 'urdu_rw' => 'آرمی ایجوکیشن کور سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'مری ہلز', 'urdu_regt' => 'آرمی ایجوکیشن', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '9.0', 'rw' => 'AK Regt Centre (RW)', 'rw_loc' => 'Mansar Camp\nAttock', 'rw_tel_no' => null, 'urdu_rw' => 'آزاد کشمیر رجمنٹ سنٹر ریکارڈز ونگ', 'urdu_rw_loc' => 'مانسر کیمپ (اٹک)', 'urdu_regt' => 'آزاد کشمیر رجمنٹ', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '13.0', 'rw' => 'AMC Centre (RW)', 'rw_loc' => 'Abbottabad Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'آرمی میڈیکل کور سنٹر ریکارڈز ونگ', 'urdu_rw_loc' => 'ایبٹ آباد کینٹ', 'urdu_regt' => 'آرمی میڈیکل کور', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '2.0', 'rw' => 'Artillery Records', 'rw_loc' => 'Attock Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'آرٹلری رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'اٹک کینٹ', 'urdu_regt' => 'آرٹلری رجمنٹ', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '12.0', 'rw' => 'ASC Centre (RW)', 'rw_loc' => 'Nowshera Cantt', 'rw_tel_no' => '03348841785', 'urdu_rw' => 'آرمی سپلائی کور سنٹر رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'نوشہرہ کینٹ', 'urdu_regt' => 'آرمی سپلائی کور', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '7.0', 'rw' => 'Baloch Regt Centre (RW)', 'rw_loc' => 'Abbottabad', 'rw_tel_no' => null, 'urdu_rw' => 'بلوچ رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'ایبٹ آباد', 'urdu_regt' => 'بلوچ رجمنٹ', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '6', 'force' => 'Other', 'regt_code' => '42.0', 'rw' => 'CMA (P)', 'rw_loc' => null, 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '11.0', 'rw' => 'CMI (Records Cell)', 'rw_loc' => 'Rawalpindi Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'کور آف ملٹری ریکارڈز سیل', 'urdu_rw_loc' => 'راولپنڈی', 'urdu_regt' => 'کور آف ملٹری', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '18.0', 'rw' => 'CMP Centre (RW)', 'rw_loc' => 'Dera Ismail Khan Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'کور آف ملٹری پولیس سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'ڈیرہ اسماعیل خان کینٹ', 'urdu_regt' => 'کور آف ملٹری پولیس', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '19.0', 'rw' => 'DSF Centre (RW)', 'rw_loc' => 'Dera Ismail Khan Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'ڈیفنس سروسز فورس سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'ڈیرہ اسماعیل خان کینٹ', 'urdu_regt' => 'ڈیفنس سروسز فورس', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '15.0', 'rw' => 'EME Centre (RW)', 'rw_loc' => 'Quetta Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'ای ایم ای سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'کوئٹہ کینٹ', 'urdu_regt' => 'ای ایم ای', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '4.0', 'rw' => 'Engineer Centre (RW)', 'rw_loc' => 'Risalpur Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'انجینئیرز کور سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'رسالپور', 'urdu_regt' => 'انجینئیرز کور', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '29.0', 'rw' => 'Army', 'rw_loc' => 'Army', 'rw_tel_no' => null, 'urdu_rw' => 'آرمی', 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '8.0', 'rw' => 'FF Regt Centre (RW)', 'rw_loc' => 'Abbottabad', 'rw_tel_no' => null, 'urdu_rw' => 'ایف ایف رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'ایبٹ آباد', 'urdu_regt' => 'ایف ایف رجمنٹ', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Other', 'regt_code' => '31.0', 'rw' => 'NLI Centre (RW)', 'rw_loc' => 'Bunji - Gilgit', 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '26.0', 'rw' => null, 'rw_loc' => 'HKSRA', 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '30.0', 'rw' => null, 'rw_loc' => null, 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Other', 'regt_code' => '32.0', 'rw' => 'NLI Centre (RW)', 'rw_loc' => 'Bunji - Gilgit', 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '21.0', 'rw' => 'Mjd Regt Centre (RW)', 'rw_loc' => 'Bhimber Azad Kashmir', 'rw_tel_no' => null, 'urdu_rw' => 'مجاہد فورس رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'بھمبر آزاد کشمیر', 'urdu_regt' => 'مجاہد فورس', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '2', 'force' => 'Navy', 'regt_code' => '27.0', 'rw' => 'Drafty Authority Pak Navy', 'rw_loc' => 'Navy', 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '20.0', 'rw' => 'NLI Centre (RW)', 'rw_loc' => 'Bunji - Gilgit', 'rw_tel_no' => null, 'urdu_rw' => 'نادرن لائٹ انفنٹری سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'بونچی - گلگت', 'urdu_regt' => 'نادرن لائٹ انفنٹری', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Other', 'regt_code' => '30.0', 'rw' => 'NLI Centre (RW)', 'rw_loc' => 'Bunji - Gilgit', 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '14.0', 'rw' => 'Ord Centre (RW)', 'rw_loc' => 'Malir Cantt - Karachi', 'rw_tel_no' => null, 'urdu_rw' => 'آرڈننس کور سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'ملیر کینٹ کراچی', 'urdu_regt' => 'آرڈننس کور', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '3', 'force' => 'PAF', 'regt_code' => '28.0', 'rw' => 'Air HQ Peshawar', 'rw_loc' => 'Peshawar', 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '5', 'force' => 'Other', 'regt_code' => '43.0', 'rw' => 'PSO', 'rw_loc' => null, 'rw_tel_no' => null, 'urdu_rw' => null, 'urdu_rw_loc' => null, 'urdu_regt' => null, 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '6.0', 'rw' => 'Punjab Regt Centre (RW)', 'rw_loc' => 'Mardan Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'پنجاب رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'مردان کینٹ', 'urdu_regt' => 'پنجاب رجمنٹ', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '17.0', 'rw' => 'RV&FC Centre (RW)', 'rw_loc' => 'Sargodha Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'آر وی اینڈ ایف سی کور کور سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'سرگودہا کینٹ', 'urdu_regt' => 'آر وی اینڈ ایف سی', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '5.0', 'rw' => 'Signals Trg Centre (RW)', 'rw_loc' => 'Kohat Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'سگنلز ٹرینگ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'کوہاٹ کینٹ', 'urdu_regt' => 'سگنلز کور', 'text_sro' => null, 'urdu_text_sro' => null],
            ['force_code' => '1', 'force' => 'Army', 'regt_code' => '10.0', 'rw' => 'Sind Regt Centre (RW)', 'rw_loc' => 'Pataro Hyderabad Cantt', 'rw_tel_no' => null, 'urdu_rw' => 'سندھ رجمنٹ سنٹر (ریکارڈز ونگ)', 'urdu_rw_loc' => 'پٹارو حیدرآباد', 'urdu_regt' => 'سندھ رجمنٹ', 'text_sro' => null, 'urdu_text_sro' => null],
        ];

        RegtCorps::insert($regts);
    }
}
