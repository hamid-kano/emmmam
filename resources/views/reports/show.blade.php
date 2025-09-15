<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المريض</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .header-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem 0; }
        .section-card { margin-bottom: 2rem; }
    </style>
</head>
<body>
    <div class="header-section">
        <div class="container">
            <h1 class="text-center">تفاصيل المريض - {{ $patient->name }}</h1>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">العودة للقائمة</a>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('reports.export') }}?patient_id={{ $patient->id }}" class="btn btn-success">
                    تصدير بيانات هذا المريض
                </a>
            </div>
        </div>

        <!-- معلومات المريض الأساسية -->
        <div class="card section-card">
            <div class="card-header bg-primary text-white">
                <h5>المعلومات الأساسية</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>الاسم:</strong> {{ $patient->name }}</p>
                        <p><strong>الهاتف:</strong> {{ $patient->phone }}</p>
                        <p><strong>البريد الإلكتروني:</strong> {{ $patient->email ?? 'غير محدد' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>تاريخ الميلاد:</strong> {{ $patient->birth_date }}</p>
                        <p><strong>الجنس:</strong> {{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                        <p><strong>العنوان:</strong> {{ $patient->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- بيانات التشخيص -->
        <div class="card section-card">
            <div class="card-header bg-info text-white">
                <h5>بيانات التشخيص</h5>
            </div>
            <div class="card-body">
                @if($patient->diagnosisDatas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>العيادة</th>
                                <th>التشخيص</th>
                                <th>الطول</th>
                                <th>الوزن</th>
                                <th>إيكو</th>
                                <th>زد سكور</th>
                                <th>مواك</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient->diagnosisDatas as $data)
                            <tr>
                                <td>{{ $data->clinic->name }}</td>
                                <td>{{ $data->diagnosis->name }}</td>
                                <td>{{ $data->height }} سم</td>
                                <td>{{ $data->weight }} كغ</td>
                                <td>{{ $data->echo ?? 'لا يوجد' }}</td>
                                <td>{{ $data->z_score ?? '-' }}</td>
                                <td>{{ $data->mwak ?? '-' }}</td>
                                <td>{{ $data->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">لا توجد بيانات تشخيص لهذا المريض</p>
                @endif
            </div>
        </div>

        <!-- بيانات الأدوية -->
        <div class="card section-card">
            <div class="card-header bg-warning text-dark">
                <h5>بيانات الأدوية</h5>
            </div>
            <div class="card-body">
                @if($patient->medicineDatas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>الدواء</th>
                                <th>رقم الطلب</th>
                                <th>مدخل البيانات</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient->medicineDatas as $medicine)
                            <tr>
                                <td>{{ $medicine->medicines }}</td>
                                <td>{{ $medicine->request_id }}</td>
                                <td>{{ $medicine->namedataentry }}</td>
                                <td>{{ $medicine->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">لا توجد بيانات أدوية لهذا المريض</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>