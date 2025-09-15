<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    protected $fillable = [
        'patient_id',
        'namedataentry',
        'status',
        'logoutdate',
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
        'logoutdate' => 'date',
        'height' => 'decimal:2',
        'weight' => 'decimal:2'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}