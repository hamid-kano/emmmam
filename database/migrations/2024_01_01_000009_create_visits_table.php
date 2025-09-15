<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->string('namedataentry');
            $table->string('status')->nullable();
            $table->date('logoutdate')->nullable();
            $table->integer('z_score')->nullable();
            $table->integer('mwak')->nullable();
            $table->string('echo')->nullable();
            $table->decimal('height', 5, 2)->nullable()->comment('الطول بالسنتيمتر');
            $table->decimal('weight', 5, 2)->nullable()->comment('الوزن بالكيلوجرام');
            $table->text('allergies')->nullable()->comment('الحساسيات');
            $table->text('current_medications')->nullable()->comment('الأدوية الحالية');
            $table->enum('smoking_status', ['non_smoker', 'former_smoker', 'current_smoker'])->nullable()->comment('حالة التدخين');
            $table->enum('statusoninter', ['conscious', 'fainted', 'semi_conscious', 'unconscious', 'oscillating_consciousness', 'no_fainting'])->nullable()->comment('حالة الوعي أثناء المقابلة');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};