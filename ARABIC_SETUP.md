# إعداد التطبيق العربي مع خط القاهرة و Tailwind CSS

## التغييرات المطبقة

### 1. تطبيق خط القاهرة (Cairo Font)
- تم إضافة خط القاهرة من Google Fonts
- تم تحديث ملف `resources/css/app.css` لاستخدام خط القاهرة كخط افتراضي
- تم تحديث جميع ملفات الـ views لاستخدام خط القاهرة

### 2. استبدال Bootstrap بـ Tailwind CSS
- تم إزالة جميع مراجع Bootstrap من الملفات
- تم تحويل جميع الـ classes إلى Tailwind CSS
- تم إنشاء تصميم جديد متجاوب باستخدام Tailwind CSS

### 3. الملفات المحدثة

#### ملفات CSS و JavaScript
- `resources/css/app.css` - إضافة خط القاهرة وإعدادات Tailwind
- `vite.config.js` - تكوين Tailwind CSS مع Vite
- `package.json` - تبعيات Tailwind CSS

#### ملفات Views
- `resources/views/layouts/app.blade.php` - Layout أساسي جديد
- `resources/views/home.blade.php` - صفحة رئيسية جديدة
- `resources/views/welcome.blade.php` - محدثة لخط القاهرة
- `resources/views/reports/index.blade.php` - محولة إلى Tailwind CSS
- `resources/views/reports/show.blade.php` - محولة إلى Tailwind CSS
- `resources/views/components/arabic-layout.blade.php` - Component للتخطيط العربي

#### ملفات Routes
- `routes/web.php` - إضافة routes جديدة

## الميزات الجديدة

### 1. دعم اللغة العربية الكامل
- اتجاه النص من اليمين إلى اليسار (RTL)
- خط القاهرة المحسن للنصوص العربية
- تخطيط متجاوب يدعم اللغة العربية

### 2. تصميم حديث مع Tailwind CSS
- تصميم نظيف ومتجاوب
- ألوان متدرجة وظلال حديثة
- أيقونات SVG مدمجة
- تأثيرات انتقالية سلسة

### 3. صفحات محسنة
- صفحة رئيسية تفاعلية مع إحصائيات
- جداول بيانات محسنة مع Tailwind CSS
- أزرار وعناصر تفاعلية محسنة

## كيفية الاستخدام

### 1. تشغيل التطبيق
```bash
# تثبيت التبعيات
npm install

# بناء الأصول
npm run build

# أو للتطوير
npm run dev
```

### 2. الوصول للصفحات
- الصفحة الرئيسية: `/`
- صفحة Laravel الأصلية: `/welcome`
- تقارير المرضى: `/reports`

### 3. استخدام Layout العربي
```php
@extends('layouts.app')

@section('content')
    <!-- المحتوى هنا -->
@endsection
```

## الألوان المستخدمة

### الألوان الأساسية
- الأزرق: `bg-blue-600` للعناوين والأزرار الأساسية
- الأخضر: `bg-green-600` لأزرار التصدير والنجاح
- الرمادي: `bg-gray-50` للخلفيات
- الأبيض: `bg-white` للبطاقات والجداول

### الألوان الثانوية
- السماوي: `bg-cyan-600` لقسم التشخيص
- الأصفر: `bg-yellow-500` لقسم الأدوية
- البنفسجي: `bg-purple-600` للتدرجات

## الخطوط المستخدمة

### خط القاهرة (Cairo)
- الأوزان المتاحة: 200, 300, 400, 500, 600, 700, 800, 900
- مُحسن للنصوص العربية والإنجليزية
- يدعم جميع الأحرف العربية والرموز

## التخصيص

### إضافة ألوان جديدة
يمكن إضافة ألوان مخصصة في ملف `resources/css/app.css`:

```css
@theme {
    --color-custom: #your-color;
}
```

### تخصيص الخط
لتغيير الخط، قم بتحديث متغير `--font-sans` في ملف CSS:

```css
@theme {
    --font-sans: 'Your Font', 'Cairo', sans-serif;
}
```

## الدعم الفني

للمساعدة في التخصيص أو إضافة ميزات جديدة، يرجى مراجعة:
- [وثائق Tailwind CSS](https://tailwindcss.com/docs)
- [وثائق Laravel](https://laravel.com/docs)
- [خطوط Google](https://fonts.google.com)