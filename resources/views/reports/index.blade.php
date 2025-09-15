<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقارير المرضى</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .header-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem 0; }
    </style>
</head>
<body>
    <div class="header-section">
        <div class="container">
            <h1 class="text-center">تقارير المرضى - مشفى الرقة</h1>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h3>قائمة المرضى</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('reports.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> تصدير إلى Excel
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>كود المريض</th>
                                <th>الاسم الكامل</th>
                                <th>الجنس</th>
                                <th>العمر</th>
                                <th>العنوان</th>
                                <th>عدد التشخيصات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                <td>{{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->age : 0 }} سنة</td>
                                <td>{{ $patient->address }}</td>
                                <td>{{ $patient->diagnosisDatas->count() }}</td>
                                <td>
                                    <a href="{{ route('reports.show', $patient) }}" class="btn btn-sm btn-primary">عرض التفاصيل</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center">
                    {{ $patients->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>