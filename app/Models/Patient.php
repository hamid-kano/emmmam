<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'birth_date',
        'gender',
        'address'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

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
}