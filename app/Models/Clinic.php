<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'status',
        'description',
        'floor',
        'room',
        'phone',
        'email',
        'address',
        'daily_capacity',
        'appointment_duration',
        'working_days',
        'working_hours',
        'tests',
        'rays',
        'equipment',
        'additional_services'
    ];

    protected $casts = [
        'equipment' => 'array',
        'daily_capacity' => 'integer',
        'appointment_duration' => 'integer'
    ];

    public function diagnosisDatas(): HasMany
    {
        return $this->hasMany(DiagnosisData::class);
    }
}