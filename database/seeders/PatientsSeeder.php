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
            $names = explode(' ', $syrianNames[$gender][array_rand($syrianNames[$gender])]);
            
            Patient::create([
                'patient_code' => 'P' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'first_name' => $names[0],
                'father_name' => $names[1] ?? 'محمد',
                'mother_name' => 'فاطمة',
                'last_name' => 'الرقاوي',
                'gender' => $gender,
                'date_of_birth' => fake()->dateTimeBetween('-80 years', '-1 year')->format('Y-m-d'),
                'address' => $areas[array_rand($areas)] . '، الرقة، سوريا',
                'phone' => '0943' . rand(100000, 999999),
                'host_idp' => ['Host', 'IDP', 'Non_IDP'][rand(0, 2)],
                'disability' => rand(0, 1) ? true : false,
                'referred' => rand(0, 1) ? true : false
            ]);
        }
    }
}