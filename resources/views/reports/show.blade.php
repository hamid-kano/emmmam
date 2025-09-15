@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg p-8 mb-6">
        <h1 class="text-3xl font-bold text-center">تفاصيل المريض - {{ $patient->full_name }}</h1>
    </div>
    <!-- Navigation Section -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('reports.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            العودة للقائمة
        </a>
        <a href="{{ route('reports.export') }}?patient_id={{ $patient->id }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            تصدير بيانات هذا المريض
        </a>
    </div>

    <!-- معلومات المريض الأساسية -->
    <div class="bg-white rounded-lg shadow-md mb-6">
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
            <h5 class="text-lg font-semibold">المعلومات الأساسية</h5>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <p class="text-gray-700"><span class="font-semibold">كود المريض:</span> {{ $patient->patient_code }}</p>
                    <p class="text-gray-700"><span class="font-semibold">الاسم الكامل:</span> {{ $patient->full_name }}</p>
                    <p class="text-gray-700"><span class="font-semibold">الهاتف:</span> {{ $patient->phone }}</p>
                    <p class="text-gray-700"><span class="font-semibold">نازح/مقيم:</span> {{ $patient->host_idp == 'IDP' ? 'نازح' : 'مقيم' }}</p>
                </div>
                <div class="space-y-3">
                    <p class="text-gray-700"><span class="font-semibold">تاريخ الميلاد:</span> {{ $patient->date_of_birth }}</p>
                    <p class="text-gray-700"><span class="font-semibold">الجنس:</span> {{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                    <p class="text-gray-700"><span class="font-semibold">العنوان:</span> {{ $patient->address }}</p>
                    <p class="text-gray-700"><span class="font-semibold">الإعاقة:</span> {{ $patient->disability ? ($patient->disability_type ?: 'يوجد') : 'لا يوجد' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- بيانات التشخيص -->
    <div class="bg-white rounded-lg shadow-md mb-6">
        <div class="bg-cyan-600 text-white px-6 py-4 rounded-t-lg">
            <h5 class="text-lg font-semibold">بيانات التشخيص</h5>
        </div>
        <div class="p-6">
            @if($patient->diagnosisDatas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">العيادة</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التشخيص</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الطول</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الوزن</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">إيكو</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">زد سكور</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">مواك</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($patient->diagnosisDatas as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->clinic->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->diagnosis->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->height }} سم</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->weight }} كغ</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->echo ?? 'لا يوجد' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->z_score ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->mwak ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-gray-500">لا توجد بيانات تشخيص لهذا المريض</p>
            @endif
        </div>
    </div>

    <!-- بيانات الأدوية -->
    <div class="bg-white rounded-lg shadow-md mb-6">
        <div class="bg-yellow-500 text-gray-900 px-6 py-4 rounded-t-lg">
            <h5 class="text-lg font-semibold">بيانات الأدوية</h5>
        </div>
        <div class="p-6">
            @if($patient->medicineDatas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الدواء</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">رقم الطلب</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">مدخل البيانات</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($patient->medicineDatas as $medicine)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $medicine->medicines }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $medicine->request_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $medicine->namedataentry }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $medicine->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-gray-500">لا توجد بيانات أدوية لهذا المريض</p>
            @endif
        </div>
    </div>
</div>
@endsection