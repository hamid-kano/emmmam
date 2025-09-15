<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    public function run(): void
    {
        $syrianNames = [
            'male' => ['محمد أحمد', 'عبد الله محمود', 'خالد حسن', 'أحمد علي', 'محمود سالم', 'عمر يوسف', 'حسام الدين', 'فراس محمد', 'بشار أحمد', 'سامر خالد'],
            'female' => ['فاطمة أحمد', 'عائشة محمد', 'زينب حسن', 'مريم علي', 'سارة محمود', 'نور الهدى', 'رغد خالد', 'لينا أحمد', 'ريم سالم', 'دعاء محمد']
        ];

        $areas = ['حي الرشيد', 'حي الثورة', 'حي المنصور', 'حي الأندلس', 'حي الجمهورية', 'حي النهضة', 'المدينة القديمة', 'حي الوحدة'];

        for ($i = 0; $i < 50; $i++) {
            $gender = rand(0, 1) ? 'male' : 'female';
            $name = $syrianNames[$gender][array_rand($syrianNames[$gender])];
            
            Patient::create([
                'name' => $name,
                'phone' => '0943' . rand(100000, 999999),
                'email' => null,
                'birth_date' => fake()->dateTimeBetween('-80 years', '-1 year')->format('Y-m-d'),
                'gender' => $gender,
                'address' => $areas[array_rand($areas)] . '، الرقة، سوريا'
            ]);
        }
    }
}