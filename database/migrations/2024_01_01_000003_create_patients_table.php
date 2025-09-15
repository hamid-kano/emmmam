<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_code')->unique();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth')->nullable();
            $table->enum('document_type', ['none', 'id', 'driver_license', 'work', 'family_card', 'passport', 'unknown', 'other'])->default('none');
            $table->string('document_number')->nullable();
            $table->string('address');
            $table->enum('education', ['Primary', 'Secondary', 'University', 'Postgraduate'])->nullable();
            $table->boolean('referred')->default(false);
            $table->string('fromreferred')->nullable();
            $table->string('whyreferred')->nullable();
            $table->string('familycount')->default('1');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('z_score')->nullable();
            $table->integer('mwak')->nullable();
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->decimal('height', 5, 2)->nullable()->comment('in cm');
            $table->decimal('weight', 5, 2)->nullable()->comment('in kg');
            $table->text('allergies')->nullable();
            $table->text('current_medications')->nullable();
            $table->enum('smoking_status', ['non_smoker', 'former_smoker', 'current_smoker'])->nullable();
            $table->enum('statusoninter', ['conscious', 'fainted', 'semi_conscious', 'unconscious', 'oscillating_consciousness', 'no_fainting'])->nullable();
            $table->enum('host_idp', ['Host', 'IDP', 'Non_IDP'])->default('Non_IDP');
            $table->boolean('disability')->default(false);
            $table->enum('disability_type', ['حركية', 'بصرية', 'سمعية', 'ذهنية', 'أخرى'])->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('echo')->nullable();
            $table->string('age', 50)->nullable();
            $table->string('agemonth')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};