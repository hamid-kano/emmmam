<?php

namespace Database\Seeders;

use App\Models\Radiology;
use Illuminate\Database\Seeder;

class RadiologySeeder extends Seeder
{
    public function run(): void
    {
        $radiologies = [
            ['name' => 'أشعة سينية', 'options' => json_encode(['صدر', 'بطن', 'عظام'])],
            ['name' => 'أشعة مقطعية', 'options' => json_encode(['رأس', 'صدر', 'بطن'])],
            ['name' => 'رنين مغناطيسي', 'options' => json_encode(['دماغ', 'عمود فقري', 'مفاصل'])],
            ['name' => 'أشعة صوتية', 'options' => json_encode(['بطن', 'حوض', 'قلب'])],
        ];

        foreach ($radiologies as $radiology) {
            Radiology::create($radiology);
        }
    }
}