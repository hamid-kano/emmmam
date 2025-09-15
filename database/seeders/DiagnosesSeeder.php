<?php

namespace Database\Seeders;

use App\Models\Diagnosis;
use Illuminate\Database\Seeder;

class DiagnosesSeeder extends Seeder
{
    public function run(): void
    {
        $diagnoses = [
            [
                'namedataentry' => 'د. أحمد محمد',
                'name' => 'ارتفاع ضغط الدم',
                'options' => 'خفيف|متوسط|شديد'
            ],
            [
                'namedataentry' => 'د. فاطمة حسن',
                'name' => 'داء السكري',
                'options' => 'النوع الأول|النوع الثاني|سكري الحمل'
            ],
            [
                'namedataentry' => 'د. محمد علي',
                'name' => 'أمراض القلب',
                'options' => 'قصور القلب|اضطراب النظم|مرض الشرايين التاجية'
            ],
            [
                'namedataentry' => 'د. زينب أحمد',
                'name' => 'أمراض الجهاز التنفسي',
                'options' => 'الربو|التهاب الشعب الهوائية|الالتهاب الرئوي'
            ],
            [
                'namedataentry' => 'د. خالد محمود',
                'name' => 'أمراض الجهاز الهضمي',
                'options' => 'قرحة المعدة|التهاب القولون|حصى المرارة'
            ],
            [
                'namedataentry' => 'د. سارة يوسف',
                'name' => 'أمراض الكلى',
                'options' => 'التهاب الكلى|حصى الكلى|قصور الكلى'
            ],
            [
                'namedataentry' => 'د. عمر سالم',
                'name' => 'أمراض العظام والمفاصل',
                'options' => 'التهاب المفاصل|هشاشة العظام|الروماتيزم'
            ],
            [
                'namedataentry' => 'د. مريم خالد',
                'name' => 'الأمراض الجلدية',
                'options' => 'الأكزيما|الصدفية|التهاب الجلد'
            ]
        ];

        foreach ($diagnoses as $diagnosis) {
            Diagnosis::create($diagnosis);
        }
    }
}