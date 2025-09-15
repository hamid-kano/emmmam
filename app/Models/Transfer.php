<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    protected $fillable = [
        'patient_id',
        'from_clinic_id',
        'to_clinic_id',
        'transfer_date',
        'reason',
        'dataentry',
        'status'
    ];

    protected $casts = [
        'transfer_date' => 'datetime'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function fromClinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class, 'from_clinic_id');
    }

    public function toClinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class, 'to_clinic_id');
    }
}