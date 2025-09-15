<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineSend extends Model
{
    protected $fillable = [
        'patient_id',
        'medicine_data_id',
        'clinic_id',
        'namedataentry',
        'medicine'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicineData(): BelongsTo
    {
        return $this->belongsTo(MedicineData::class);
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }
}