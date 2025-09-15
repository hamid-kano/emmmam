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
        
        // الشيت الأساسي - معلومات المرضى الأساسية فقط
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('البيانات الأساسية');
        
        $basicHeaders = ['كود المريض', 'الاسم الكامل', 'الجنس', 'العمر(بالسنوات)', 'العمر(الاشهر)', 'نازح/مقيم', 'العنوان', 'الاعاقة', 'إحالة من منشأة أخرى؟', 'الهاتف', 'رقم الهوية', 'فصيلة الدم'];
        $sheet->fromArray($basicHeaders, null, 'A1');
        
        $patients = Patient::all();
        $row = 2;
        foreach ($patients as $patient) {
            $age = $patient->age ?: ($patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->age : 0);
            $ageMonths = $patient->agemonth ?: ($patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->diffInMonths(now()) : 0);
            
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
                $patient->phone ?: 'لا يوجد',
                $patient->document_number ?: 'لا يوجد',
                $patient->blood_type ?: 'غير محدد'
            ], null, 'A' . $row);
            $row++;
        }

        // إنشاء شيت منفصل لكل قسم مع البيانات الطبية الكاملة
        $clinics = \App\Models\Clinic::all();
        $clinicHeaders = ['كود المريض', 'الاسم الكامل', 'الجنس', 'العمر(بالسنوات)', 'العمر(الاشهر)', 'نازح/مقيم', 'العنوان', 'الاعاقة', 'إحالة من منشأة أخرى؟', 'التصنيف الرئيسي للأمراض', 'التشخيص', 'اذا أخرى, الرجاء التحديد؟', 'نوع الأشعة', 'النوع', 'نوع التحاليل المخبرية', 'الأدوية', 'حالة التخريج', 'إذا أحيل أو توفى فما السبب؟', 'إيكو', 'قياس زد سكور', 'قياس مواك', 'ملاحظات'];
        
        foreach ($clinics as $clinic) {
            $clinicSheet = $spreadsheet->createSheet();
            $clinicSheet->setTitle($clinic->name);
            $clinicSheet->fromArray($clinicHeaders, null, 'A1');
            
            $clinicPatients = DiagnosisData::select(
                    'diagnosis_datas.*',
                    'patients.*',
                    'diagnoses.name as diagnosis_name',
                    'radiologies.name as radiology_name',
                    'radio_datas.suboption as radio_suboption',
                    'tests.name as test_name',
                    'visits.status as visit_status',
                    'medicine_datas.medicines'
                )
                ->join('patients', 'diagnosis_datas.patient_id', '=', 'patients.id')
                ->join('diagnoses', 'diagnosis_datas.diagnoses_id', '=', 'diagnoses.id')
                ->leftJoin('radio_datas', 'patients.id', '=', 'radio_datas.patient_id')
                ->leftJoin('radiologies', 'radio_datas.ray_id', '=', 'radiologies.id')
                ->leftJoin('test_datas', 'patients.id', '=', 'test_datas.patient_id')
                ->leftJoin('tests', 'test_datas.test_id', '=', 'tests.id')
                ->leftJoin('visits', 'patients.id', '=', 'visits.patient_id')
                ->leftJoin('medicine_datas', 'patients.id', '=', 'medicine_datas.patient_id')
                ->where('diagnosis_datas.clinic_id', $clinic->id)
                ->get();
            
            $row = 2;
            foreach ($clinicPatients as $data) {
                $age = $data->age ?: ($data->date_of_birth ? \Carbon\Carbon::parse($data->date_of_birth)->age : 0);
                $ageMonths = $data->agemonth ?: ($data->date_of_birth ? \Carbon\Carbon::parse($data->date_of_birth)->diffInMonths(now()) : 0);
                $fullName = $data->first_name . ' ' . $data->father_name . ' ' . $data->mother_name . ' ' . $data->last_name;
                
                $clinicSheet->fromArray([
                    $data->patient_code,
                    $fullName,
                    $data->gender == 'male' ? 'ذكر' : 'أنثى',
                    $age,
                    $ageMonths,
                    $data->host_idp == 'IDP' ? 'نازح' : 'مقيم',
                    $data->address,
                    $data->disability ? ($data->disability_type ?: 'يوجد') : 'لا يوجد',
                    $data->referred ? 'نعم' : 'لا',
                    $data->diagnosis_name ?: 'لا يوجد',
                    $data->suboption ?: 'لا يوجد',
                    'لا يوجد',
                    $data->radiology_name ?: 'لا يوجد',
                    $data->radio_suboption ?: 'لا يوجد',
                    $data->test_name ?: 'لا يوجد',
                    $data->medicines ?: 'لا يوجد',
                    $data->visit_status ?: 'مقيم',
                    $data->visit_status == 'transferred' ? 'تحويل طبي' : 'لا يوجد',
                    $data->echo ?: 'لا يوجد',
                    $data->z_score ?: '0',
                    $data->mwak ?: '0',
                    $data->additional_notes ?: 'لا يوجد'
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