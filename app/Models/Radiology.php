<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Radiology extends Model
{
    protected $fillable = [
        'name',
        'options'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function radioDatas(): HasMany
    {
        return $this->hasMany(RadioData::class, 'ray_id');
    }
}