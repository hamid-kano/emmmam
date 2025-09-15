<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineData extends Model
{
    protected $table = 'medicine_datas';
    
    protected $fillable = [
        'patient_id',
        'request_id',
        'namedataentry',
        'medicines'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}