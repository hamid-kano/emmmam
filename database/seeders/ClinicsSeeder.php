<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;

class ClinicsSeeder extends Seeder
{
    public function run(): void
    {
        $clinics = [
            ['name' => 'عيادة الباطنة العامة', 'code' => 'INT001', 'type' => 'internal_medicine', 'floor' => '1', 'room' => '101'],
            ['name' => 'عيادة القلبية', 'code' => 'CAR001', 'type' => 'cardiology', 'floor' => '2', 'room' => '201'],
            ['name' => 'عيادة الأطفال', 'code' => 'PED001', 'type' => 'pediatrics', 'floor' => '1', 'room' => '105'],
            ['name' => 'عيادة النسائية والتوليد', 'code' => 'GYN001', 'type' => 'gynecology', 'floor' => '3', 'room' => '301'],
            ['name' => 'عيادة العظمية', 'code' => 'ORT001', 'type' => 'orthopedics', 'floor' => '2', 'room' => '205'],
            ['name' => 'عيادة الجلدية', 'code' => 'DER001', 'type' => 'dermatology', 'floor' => '1', 'room' => '110'],
            ['name' => 'عيادة العيون', 'code' => 'OPH001', 'type' => 'ophthalmology', 'floor' => '2', 'room' => '210'],
            ['name' => 'عيادة الأنف والأذن والحنجرة', 'code' => 'ENT001', 'type' => 'ent', 'floor' => '2', 'room' => '215'],
        ];

        foreach ($clinics as $clinic) {
            Clinic::create([
                'name' => $clinic['name'],
                'code' => $clinic['code'],
                'type' => $clinic['type'],
                'status' => 'active',
                'description' => 'عيادة متخصصة في مشفى الرقة العام',
                'floor' => $clinic['floor'],
                'room' => $clinic['room'],
                'phone' => '0943' . rand(100000, 999999),
                'address' => 'مشفى الرقة العام، الرقة، سوريا',
                'daily_capacity' => rand(15, 30),
                'appointment_duration' => 30,
                'working_days' => 'السبت-الخميس',
                'working_hours' => '08:00-14:00',
            ]);
        }
    }
}