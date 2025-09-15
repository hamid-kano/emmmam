<?php

namespace Database\Seeders;

use App\Models\RadioData;
use App\Models\Patient;
use App\Models\Radiology;
use Illuminate\Database\Seeder;

class RadioDataSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $radiologies = Radiology::all();

        foreach ($radiologies as $radiology) {
            $radioPatients = $patients->random(3);
            foreach ($radioPatients as $patient) {
                RadioData::create([
                    'ray_id' => $radiology->id,
                    'patient_id' => $patient->id,
                    'suboption' => 'طبيعي'
                ]);
            }
        }
    }
}