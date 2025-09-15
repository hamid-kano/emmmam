<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosisData extends Model
{
    protected $table = 'diagnosis_datas';
    
    protected $fillable = [
        'patient_id',
        'clinic_id',
        'diagnoses_id',
        'suboption',
        'namedataentry',
        'z_score',
        'mwak',
        'echo',
        'height',
        'weight',
        'allergies',
        'current_medications',
        'smoking_status',
        'statusoninter'
    ];

    protected $casts = [
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'z_score' => 'integer',
        'mwak' => 'integer'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class, 'diagnoses_id');
    }
}