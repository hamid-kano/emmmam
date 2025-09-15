<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ClinicsSeeder::class,
            PatientsSeeder::class,
            DiagnosesSeeder::class,
            MedicinesSeeder::class,
            RadiologySeeder::class,
            TestSeeder::class,
            CardsSeeder::class,
            DiagnosisDataSeeder::class,
            MedicineDataSeeder::class,
            RadioDataSeeder::class,
            TestDataSeeder::class,
            VisitSeeder::class,
            BackupsSeeder::class,
        ]);
    }
}