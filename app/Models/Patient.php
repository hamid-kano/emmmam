<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'patient_code',
        'first_name',
        'father_name',
        'mother_name',
        'last_name',
        'gender',
        'date_of_birth',
        'document_type',
        'document_number',
        'address',
        'education',
        'referred',
        'fromreferred',
        'whyreferred',
        'familycount',
        'phone',
        'whatsapp',
        'mobile',
        'z_score',
        'mwak',
        'blood_type',
        'height',
        'weight',
        'allergies',
        'current_medications',
        'smoking_status',
        'statusoninter',
        'host_idp',
        'disability',
        'disability_type',
        'additional_notes',
        'emergency_contact',
        'emergency_phone',
        'echo',
        'age',
        'agemonth'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'referred' => 'boolean',
        'disability' => 'boolean',
        'height' => 'decimal:2',
        'weight' => 'decimal:2'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->father_name . ' ' . $this->mother_name . ' ' . $this->last_name;
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function diagnosisDatas(): HasMany
    {
        return $this->hasMany(DiagnosisData::class);
    }

    public function medicineDatas(): HasMany
    {
        return $this->hasMany(MedicineData::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function radioDatas(): HasMany
    {
        return $this->hasMany(RadioData::class);
    }

    public function testDatas(): HasMany
    {
        return $this->hasMany(TestData::class);
    }
}