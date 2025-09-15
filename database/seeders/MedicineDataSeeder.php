<?php

namespace Database\Seeders;

use App\Models\MedicineData;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class MedicineDataSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $dataEntryNames = ['د. أحمد محمد', 'د. فاطمة حسن', 'د. محمد علي'];
        $medicines = ['باراسيتامول', 'إيبوبروفين', 'أموكسيسيلين', 'أسبرين'];

        for ($i = 0; $i < 25; $i++) {
            MedicineData::create([
                'patient_id' => $patients->random()->id,
                'request_id' => rand(1000, 9999),
                'namedataentry' => $dataEntryNames[array_rand($dataEntryNames)],
                'medicines' => $medicines[array_rand($medicines)]
            ]);
        }
    }
}