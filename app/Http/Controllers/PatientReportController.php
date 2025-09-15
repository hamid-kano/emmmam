<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\DiagnosisData;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PatientReportController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['diagnosisDatas.clinic', 'diagnosisDatas.diagnosis'])->paginate(10);
        return view('reports.index', compact('patients'));
    }

    public function show(Patient $patient)
    {
        $patient->load(['diagnosisDatas.clinic', 'diagnosisDatas.diagnosis', 'cards', 'medicineDatas']);
        return view('reports.show', compact('patient'));
    }

    public function exportExcel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        
        // الشيت الأساسي - معلومات المرضى
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('المرضى الأساسية');
        
        $headers = ['كود المريض', 'الاسم الكامل', 'الجنس', 'العمر(بالسنوات)', 'العمر(الاشهر)', 'نازح/مقيم', 'العنوان', 'الاعاقة', 'إحالة من منشأة أخرى؟', 'التصنيف الرئيسي للأمراض', 'التشخيص', 'اذا أخرى, الرجاء التحديد؟', 'نوع الأشعة', 'النوع', 'نوع التحاليل المخبرية', 'الأدوية', 'حالة التخريج', 'إذا أحيل أو توفى فما السبب؟', 'إيكو', 'قياس زد سكور', 'قياس مواك', 'ملاحظات'];
        $sheet->fromArray($headers, null, 'A1');
        
        $patients = Patient::with(['diagnosisDatas.clinic', 'diagnosisDatas.diagnosis', 'medicineDatas', 'visits', 'radioDatas.radiology', 'testDatas.test'])->get();
        $row = 2;
        foreach ($patients as $patient) {
            $age = $patient->age ?: ($patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->age : 0);
            $ageMonths = $patient->agemonth ?: ($patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->diffInMonths(now()) : 0);
            
            $diagnosisData = $patient->diagnosisDatas->first();
            $medicineData = $patient->medicineDatas->pluck('medicines')->implode(', ');
            $visit = $patient->visits->first();
            $radioData = $patient->radioDatas->first();
            $testData = $patient->testDatas->first();
            
            $sheet->fromArray([
                $patient->patient_code,
                $patient->full_name,
                $patient->gender == 'male' ? 'ذكر' : 'أنثى',
                $age,
                $ageMonths,
                $patient->host_idp == 'IDP' ? 'نازح' : 'مقيم',
                $patient->address,
                $patient->disability ? ($patient->disability_type ?: 'يوجد') : 'لا يوجد',
                $patient->referred ? 'نعم' : 'لا',
                $diagnosisData ? $diagnosisData->diagnosis->name : '',
                $diagnosisData ? $diagnosisData->suboption : '',
                '',
                $radioData ? $radioData->radiology->name : '',
                '',
                $testData ? $testData->test->name : '',
                $medicineData,
                $visit ? $visit->status : '',
                '',
                $patient->echo ?: ($diagnosisData ? $diagnosisData->echo : ''),
                $patient->z_score ?: ($diagnosisData ? $diagnosisData->z_score : ''),
                $patient->mwak ?: ($diagnosisData ? $diagnosisData->mwak : ''),
                $patient->additional_notes
            ], null, 'A' . $row);
            $row++;
        }

        // إنشاء شيتات للأقسام المختلفة
        $clinics = \App\Models\Clinic::all();
        foreach ($clinics as $clinic) {
            $clinicSheet = $spreadsheet->createSheet();
            $clinicSheet->setTitle($clinic->name);
            $clinicSheet->fromArray($headers, null, 'A1');
            
            $clinicPatients = DiagnosisData::with(['patient', 'diagnosis'])
                ->where('clinic_id', $clinic->id)
                ->get();
            
            $row = 2;
            foreach ($clinicPatients as $data) {
                $patient = $data->patient;
                $age = $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->age : 0;
                $ageMonths = $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->diffInMonths(now()) : 0;
                
                $clinicSheet->fromArray([
                    $patient->patient_code,
                    $patient->full_name,
                    $patient->gender == 'male' ? 'ذكر' : 'أنثى',
                    $age,
                    $ageMonths,
                    $patient->host_idp == 'IDP' ? 'نازح' : 'مقيم',
                    $patient->address,
                    $patient->disability ? ($patient->disability_type ?: 'يوجد') : 'لا يوجد',
                    $patient->referred ? 'نعم' : 'لا',
                    $data->diagnosis->name,
                    $data->suboption,
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    $data->echo,
                    $data->z_score,
                    $data->mwak,
                    $patient->additional_notes
                ], null, 'A' . $row);
                $row++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'تقرير_المرضى_' . date('Y_m_d_H_i_s') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}