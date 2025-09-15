<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RadioData extends Model
{
    protected $table = 'radio_datas';
    
    protected $fillable = [
        'ray_id',
        'patient_id',
        'suboption'
    ];

    public function radiology(): BelongsTo
    {
        return $this->belongsTo(Radiology::class, 'ray_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}