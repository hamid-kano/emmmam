<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diagnosis extends Model
{
    protected $fillable = [
        'namedataentry',
        'name',
        'options'
    ];

    public function diagnosisDatas(): HasMany
    {
        return $this->hasMany(DiagnosisData::class, 'diagnoses_id');
    }
}