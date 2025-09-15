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
            CardsSeeder::class,
            DiagnosisDataSeeder::class,
            MedicineDataSeeder::class,
            BackupsSeeder::class,
        ]);
    }
}