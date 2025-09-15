<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class CardsSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $dataEntryNames = ['أحمد محمد', 'فاطمة حسن', 'محمد علي', 'زينب أحمد', 'خالد محمود'];

        foreach ($patients->take(30) as $patient) {
            Card::create([
                'patient_id' => $patient->id,
                'namedataentry' => $dataEntryNames[array_rand($dataEntryNames)]
            ]);
        }
    }
}