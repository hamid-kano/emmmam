<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('from_clinic_id')->nullable()->constrained('clinics')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('to_clinic_id')->constrained('clinics')->onDelete('restrict')->onUpdate('cascade');
            $table->dateTime('transfer_date');
            $table->text('reason')->nullable();
            $table->string('dataentry')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};