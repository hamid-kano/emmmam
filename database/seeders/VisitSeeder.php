<?php

namespace Database\Seeders;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $statuses = ['admitted', 'discharged', 'transferred', 'deceased'];
        $dataEntryNames = ['د. أحمد محمد', 'د. فاطمة حسن', 'د. محمد علي'];

        foreach ($patients->take(30) as $patient) {
            Visit::create([
                'patient_id' => $patient->id,
                'namedataentry' => $dataEntryNames[array_rand($dataEntryNames)],
                'status' => $statuses[array_rand($statuses)],
                'logoutdate' => rand(0, 1) ? now()->subDays(rand(1, 30))->format('Y-m-d') : null,
            ]);
        }
    }
}