<?php

namespace Database\Seeders;

use App\Models\DiagnosisData;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Diagnosis;
use Illuminate\Database\Seeder;

class DiagnosisDataSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $clinics = Clinic::all();
        $diagnoses = Diagnosis::all();
        $dataEntryNames = ['د. أحمد محمد', 'د. فاطمة حسن', 'د. محمد علي', 'د. زينب أحمد'];

        for ($i = 0; $i < 40; $i++) {
            DiagnosisData::create([
                'patient_id' => $patients->random()->id,
                'clinic_id' => $clinics->random()->id,
                'diagnoses_id' => $diagnoses->random()->id,
                'suboption' => 'متوسط',
                'namedataentry' => $dataEntryNames[array_rand($dataEntryNames)],
                'z_score' => rand(-3, 3),
                'mwak' => rand(1, 5),
                'echo' => rand(0, 1) ? 'طبيعي' : 'غير طبيعي',
                'height' => rand(150, 190),
                'weight' => rand(50, 100),
                'allergies' => rand(0, 1) ? 'لا يوجد' : 'حساسية من البنسلين',
                'current_medications' => rand(0, 1) ? 'لا يوجد' : 'باراسيتامول',
                'smoking_status' => ['non_smoker', 'former_smoker', 'current_smoker'][rand(0, 2)],
                'statusoninter' => ['conscious', 'semi_conscious'][rand(0, 1)]
            ]);
        }
    }
}