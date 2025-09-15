<?php

namespace Database\Seeders;

use App\Models\TestData;
use App\Models\Patient;
use App\Models\Test;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $tests = Test::all();

        foreach ($tests as $test) {
            $testPatients = $patients->random(4);
            foreach ($testPatients as $patient) {
                TestData::create([
                    'test_id' => $test->id,
                    'patient_id' => $patient->id,
                    'suboption' => 'طبيعي'
                ]);
            }
        }
    }
}