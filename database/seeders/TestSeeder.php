<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $tests = [
            ['name' => 'تحليل دم شامل', 'options' => json_encode(['CBC', 'ESR', 'CRP'])],
            ['name' => 'تحليل بول', 'options' => json_encode(['عام', 'مزرعة', 'حساسية'])],
            ['name' => 'تحليل سكر', 'options' => json_encode(['صائم', 'عشوائي', 'تراكمي'])],
            ['name' => 'وظائف كلى', 'options' => json_encode(['يوريا', 'كرياتينين', 'حمض البوليك'])],
        ];

        foreach ($tests as $test) {
            Test::create($test);
        }
    }
}