<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicinesSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [
            ['items' => 'باراسيتامول', 'unit' => 'قرص', 'dosage' => '500 ملغ'],
            ['items' => 'إيبوبروفين', 'unit' => 'قرص', 'dosage' => '400 ملغ'],
            ['items' => 'أموكسيسيلين', 'unit' => 'كبسولة', 'dosage' => '500 ملغ'],
            ['items' => 'أسبرين', 'unit' => 'قرص', 'dosage' => '100 ملغ'],
            ['items' => 'ميتفورمين', 'unit' => 'قرص', 'dosage' => '850 ملغ'],
            ['items' => 'أملوديبين', 'unit' => 'قرص', 'dosage' => '5 ملغ'],
            ['items' => 'لوسارتان', 'unit' => 'قرص', 'dosage' => '50 ملغ'],
            ['items' => 'أتورفاستاتين', 'unit' => 'قرص', 'dosage' => '20 ملغ'],
            ['items' => 'أوميبرازول', 'unit' => 'كبسولة', 'dosage' => '20 ملغ'],
            ['items' => 'سيتيريزين', 'unit' => 'قرص', 'dosage' => '10 ملغ'],
            ['items' => 'سالبوتامول', 'unit' => 'بخاخ', 'dosage' => '100 مكغ'],
            ['items' => 'ديكلوفيناك', 'unit' => 'قرص', 'dosage' => '50 ملغ'],
            ['items' => 'فيتامين د', 'unit' => 'كبسولة', 'dosage' => '1000 وحدة'],
            ['items' => 'حمض الفوليك', 'unit' => 'قرص', 'dosage' => '5 ملغ'],
            ['items' => 'كالسيوم', 'unit' => 'قرص', 'dosage' => '600 ملغ'],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}