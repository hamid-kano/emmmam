<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('type');
            $table->string('status')->default('active');
            $table->text('description')->nullable();
            $table->string('floor')->nullable();
            $table->string('room')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->integer('daily_capacity')->default(20);
            $table->integer('appointment_duration')->default(30);
            $table->string('working_days')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('tests')->nullable();
            $table->string('rays')->nullable();
            $table->json('equipment')->nullable();
            $table->text('additional_services')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};